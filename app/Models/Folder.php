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
        'is_active', // ✅ IMPORTANTE
    ];

    protected $casts = [
        'depth' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Boot
     */
    protected static function booted()
    {
        static::creating(function ($folder) {

            // ✅ Slug único
            $folder->slug = self::generateUniqueSlug($folder->name);

            // ✅ Obtener parent correctamente
            $parent = $folder->parent_id
                ? self::find($folder->parent_id)
                : null;

            $folder->depth = $parent ? $parent->depth + 1 : 0;

            $folder->full_path = $parent
                ? $parent->full_path . ' > ' . $folder->name
                : $folder->name;
        });

        static::updating(function ($folder) {

            if ($folder->isDirty(['parent_id', 'name'])) {

                $parent = $folder->parent_id
                    ? self::find($folder->parent_id)
                    : null;

                $folder->depth = $parent ? $parent->depth + 1 : 0;

                $folder->full_path = $parent
                    ? $parent->full_path . ' > ' . $folder->name
                    : $folder->name;
            }
        });

        // 🔥 Mejor hacerlo después del update
        static::updated(function ($folder) {
            if ($folder->wasChanged(['parent_id', 'name'])) {
                $folder->updateChildrenPaths();
            }
        });
    }

    /**
     * Slug único automático
     */
    public static function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * Actualizar hijos recursivamente
     */
    public function updateChildrenPaths(): void
    {
        foreach ($this->children()->get() as $child) {

            $child->depth = $this->depth + 1;
            $child->full_path = $this->full_path . ' > ' . $child->name;

            $child->save();

            // recursion controlada
            $child->updateChildrenPaths();
        }
    }
    public function firmware(): HasMany
    {
        return $this->hasMany(Firmware::class, 'folder_id');
    }
    /**
     * Relaciones
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function firmwares(): HasMany
    {
        return $this->hasMany(Firmware::class, 'folder_id');
    }

    /**
     * Accessor icono
     */
    public function getIconUrlAttribute(): string
    {
        return $this->icon_path
            ? asset('storage/' . $this->icon_path)
            : asset('images/folder-default.png');
    }

    /**
     * Route model binding por slug
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
