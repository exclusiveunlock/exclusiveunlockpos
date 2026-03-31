<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Relaciones
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Traits opcionales (recomendado)
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'currency_id',
        'phone',
        'password',
        'pin',
        'role_id',
        'role',
        'is_admin',
        'is_reseller',
        'balance',
        'total_credit',
        'total_debit',
        'package_id',
        'package_expires_at',
        'bandwidth_used',
        'total_files_used',
        'daily_files_used',
        'files_downloaded',
        'google2fa_secret',
        'last_login_at',
        'last_login_ip',
        'theme',
        'new_firmware_notifications',
        'security_alerts',
        'marketing_emails',
        'otp',
        'otp_expires_at',
        'is_verified',
        'default_shipping_address_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'pin',
        'google2fa_secret',
        'otp',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'package_expires_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'last_login_at' => 'datetime',

        'is_admin' => 'boolean',
        'is_reseller' => 'boolean',
        'is_verified' => 'boolean',

        'new_firmware_notifications' => 'boolean',
        'security_alerts' => 'boolean',
        'marketing_emails' => 'boolean',

        'balance' => 'decimal:2',
        'total_credit' => 'decimal:2',
        'total_debit' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // Moneda
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    // Paquete
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    // Dirección por defecto
    public function defaultShippingAddress(): BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class, 'default_shipping_address_id');
    }

    // Direcciones
    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(ShippingAddress::class);
    }

    // Órdenes
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isReseller(): bool
    {
        return $this->is_reseller;
    }

    public function hasActivePackage(): bool
    {
        return $this->package_expires_at && $this->package_expires_at->isFuture();
    }
}