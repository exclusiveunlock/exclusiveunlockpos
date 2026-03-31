<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileServer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_servers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'api_url',
        'api_key',
        'api_secret',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'api_key',
        'api_secret',
    ];

    /**
     * Get the firmwares stored on this file server.
     */
    public function firmwares(): HasMany
    {
        return $this->hasMany(Firmware::class, 'file_server_id');
    }

    /**
     * Scope a query to search by name.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%");
    }

    /**
     * Get the firmware count.
     */
    public function getFirmwaresCountAttribute(): int
    {
        return $this->firmwares()->count();
    }

    /**
     * Check if the server is valid (has required fields).
     */
    public function isValid(): bool
    {
        return !empty($this->name) && !empty($this->api_url) && !empty($this->api_key);
    }

    /**
     * Get masked API key for display.
     */
    public function getMaskedApiKeyAttribute(): string
    {
        return substr($this->api_key, 0, 4) . '...' . substr($this->api_key, -4);
    }

    /**
     * Get masked API secret for display.
     */
    public function getMaskedApiSecretAttribute(): string
    {
        return substr($this->api_secret, 0, 4) . '...' . substr($this->api_secret, -4);
    }
}