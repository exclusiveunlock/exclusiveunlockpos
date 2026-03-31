<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Firmware extends Model
{
    protected $table = 'firmware';

    protected $fillable = [
        'name',
        'slug',
        'icon_path',
        'description',
        'type',
        'price',
        'path',
        'size', // 🔥 ahora en bytes
        'upload_type',
        'url',
        'ftp_host',
        'ftp_username',
        'ftp_password',
        'ftp_path',
        'folder_id',
        'file_server_id',
        'password',
        'downloads_count',
        'views_count',
        'rating',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'size' => 'integer', // 🔥 CAMBIO CLAVE
        'rating' => 'decimal:1',
        'downloads_count' => 'integer',
        'views_count' => 'integer',
    ];

    // ========================
    // 🔗 RELACIONES
    // ========================

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function fileServer(): BelongsTo
    {
        return $this->belongsTo(FileServer::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'firmware_tag');
    }

    // ========================
    // 📦 ACCESSOR PRO
    // ========================

    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;

        if (!$bytes) {
            return '0 B';
        }

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}