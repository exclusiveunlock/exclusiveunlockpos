<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'bandwidth',
        'files',
        'price',
        'device_limit',
        'bandwidth_unit',
        'total_bandwidth',
        'daily_bandwidth',
        'daily_files',
        'total_files',
        'can_access_password_files',
        'dhru_fusion_service_id',
        'currency_id',
        'files_unit',
        'duration_in_months',
        'package_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'bandwidth' => 'integer',
        'files' => 'integer',
        'device_limit' => 'integer',
        'total_bandwidth' => 'integer',
        'daily_bandwidth' => 'integer',
        'daily_files' => 'integer',
        'total_files' => 'integer',
        'can_access_password_files' => 'boolean',
        'duration_in_months' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the currency associated with the package.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the users who have this package.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get active users with this package.
     */
    public function activeUsers(): HasMany
    {
        return $this->users()->where('package_expires_at', '>', now());
    }

    /**
     * Scope a query to only include free packages.
     */
    public function scopeFree($query)
    {
        return $query->where('package_type', 'free');
    }

    /**
     * Scope a query to only include paid packages.
     */
    public function scopePaid($query)
    {
        return $query->where('package_type', 'paid');
    }

    /**
     * Scope a query to only include packages with password access.
     */
    public function scopeWithPasswordAccess($query)
    {
        return $query->where('can_access_password_files', true);
    }

    /**
     * Scope a query to search by title.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%");
    }

    /**
     * Get the formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        if ($this->package_type === 'free') {
            return 'Free';
        }
        
        $currency = $this->currency ? $this->currency->symbol : '$';
        return $currency . number_format($this->price, 2);
    }

    /**
     * Get the formatted bandwidth.
     */
    public function getFormattedBandwidthAttribute(): string
    {
        return number_format($this->bandwidth) . ' ' . $this->bandwidth_unit;
    }

    /**
     * Get the total bandwidth in bytes.
     */
    public function getTotalBandwidthBytesAttribute(): int
    {
        $multipliers = [
            'KB' => 1024,
            'MB' => 1024 ** 2,
            'GB' => 1024 ** 3,
            'TB' => 1024 ** 4,
        ];
        
        $multiplier = $multipliers[$this->bandwidth_unit] ?? 1;
        return $this->bandwidth * $multiplier;
    }

    /**
     * Get the formatted total bandwidth.
     */
    public function getFormattedTotalBandwidthAttribute(): string
    {
        return number_format($this->total_bandwidth) . ' ' . $this->bandwidth_unit;
    }

    /**
     * Get the formatted daily bandwidth.
     */
    public function getFormattedDailyBandwidthAttribute(): string
    {
        return number_format($this->daily_bandwidth) . ' ' . $this->bandwidth_unit;
    }

    /**
     * Get the formatted files limit.
     */
    public function getFormattedFilesAttribute(): string
    {
        return number_format($this->files) . ' ' . $this->files_unit;
    }

    /**
     * Get the formatted total files.
     */
    public function getFormattedTotalFilesAttribute(): string
    {
        return number_format($this->total_files) . ' ' . $this->files_unit;
    }

    /**
     * Get the formatted daily files.
     */
    public function getFormattedDailyFilesAttribute(): string
    {
        return number_format($this->daily_files) . ' ' . $this->files_unit;
    }

    /**
     * Get the duration in months.
     */
    public function getDurationAttribute(): string
    {
        if ($this->duration_in_months == 1) {
            return '1 month';
        }
        
        return $this->duration_in_months . ' months';
    }

    /**
     * Check if the package is free.
     */
    public function isFree(): bool
    {
        return $this->package_type === 'free';
    }

    /**
     * Check if the package is paid.
     */
    public function isPaid(): bool
    {
        return $this->package_type === 'paid';
    }

    /**
     * Check if the package allows access to password-protected files.
     */
    public function canAccessPasswordFiles(): bool
    {
        return (bool) $this->can_access_password_files;
    }

    /**
     * Get the user count for this package.
     */
    public function getUserCountAttribute(): int
    {
        return $this->users()->count();
    }

    /**
     * Get the active user count for this package.
     */
    public function getActiveUserCountAttribute(): int
    {
        return $this->activeUsers()->count();
    }
}