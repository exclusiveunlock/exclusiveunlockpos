<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'show_in_footer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'show_in_footer' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Scope a query to only include pages shown in footer.
     */
    public function scopeInFooter($query)
    {
        return $query->where('show_in_footer', true);
    }

    /**
     * Scope a query to only include pages not shown in footer.
     */
    public function scopeNotInFooter($query)
    {
        return $query->where('show_in_footer', false);
    }

    /**
     * Scope a query to search by title or content.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%")
                     ->orWhere('content', 'LIKE', "%{$search}%");
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the short content (first 200 characters).
     */
    public function getShortContentAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 200);
    }

    /**
     * Get the excerpt (first 100 characters).
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 100);
    }

    /**
     * Get the URL for the page.
     */
    public function getUrlAttribute(): string
    {
        return url('/pages/' . $this->slug);
    }

    /**
     * Get the formatted created date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Get the formatted updated date.
     */
    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->format('d/m/Y H:i');
    }
}