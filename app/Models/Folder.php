<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Folder extends Model
{
    use HasFactory;

    protected $table = 'folders';

    protected $fillable = [
        'name',
        'slug',
        'icon_path',
        'parent_id',
        'depth',
        'full_path',
    ];

    protected $casts = [
        'depth' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($folder) {
            if (empty($folder->slug)) {
                $folder->slug = Str::slug($folder->name);
            }
            $folder->depth = $folder->parent ? $folder->parent->depth + 1 : 0;
            $folder->full_path = $folder->generateFullPath();
        });

        static::updating(function ($folder) {
            if ($folder->isDirty('parent_id') || $folder->isDirty('name')) {
                $folder->depth = $folder->parent ? $folder->parent->depth + 1 : 0;
                $folder->full_path = $folder->generateFullPath();
                $folder->updateChildrenPaths();
            }
        });
    }

    /**
     * Generate the full path for the folder
     */
    public function generateFullPath(): string
    {
        if ($this->parent) {
            return $this->parent->full_path . ' > ' . $this->name;
        }
        return $this->name;
    }

    /**
     * Update paths for all children
     */
    public function updateChildrenPaths()
    {
        foreach ($this->children as $child) {
            $child->depth = $this->depth + 1;
            $child->full_path = $this->full_path . ' > ' . $child->name;
            $child->save();
            $child->updateChildrenPaths();
        }
    }

    /**
     * Get the parent folder
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    /**
     * Get the child folders
     */
    public function children(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    /**
     * Get the firmwares in this folder
     */
    public function firmwares(): HasMany
    {
        return $this->hasMany(Firmware::class, 'folder_id');
    }
    public function getIconUrlAttribute(): string
    {
        if ($this->icon_path) {
            return asset('storage/' . $this->icon_path);
        }

        // Imagen por defecto en public/images/folder-default.png
        return asset('images/folder-default.png');
    }
    /**
     * Get the route key for the model
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
}
