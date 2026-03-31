<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reviews extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'review',
        'is_verified_purchase',
        'is_approved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'is_verified_purchase' => 'boolean',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product that owns the review.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get the user who wrote the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope a query to only include approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope a query to only include pending reviews (not approved).
     */
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    /**
     * Scope a query to only include verified purchases.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified_purchase', true);
    }

    /**
     * Scope a query to only include reviews with a specific rating.
     */
    public function scopeRating($query, int $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope a query to only include high ratings (4 or 5 stars).
     */
    public function scopeHighRating($query)
    {
        return $query->where('rating', '>=', 4);
    }

    /**
     * Scope a query to only include low ratings (1 or 2 stars).
     */
    public function scopeLowRating($query)
    {
        return $query->where('rating', '<=', 2);
    }

    /**
     * Get the star rating as a string of stars.
     */
    public function getStarsAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Get the star rating with HTML.
     */
    public function getStarsHtmlAttribute(): string
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<span class="text-warning">★</span>';
            } else {
                $stars .= '<span class="text-secondary">☆</span>';
            }
        }
        return $stars;
    }

    /**
     * Determine if the review is approved.
     */
    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    /**
     * Determine if the review is from a verified purchase.
     */
    public function isVerifiedPurchase(): bool
    {
        return $this->is_verified_purchase;
    }

    /**
     * Determine if the review is high rated (4 or 5 stars).
     */
    public function isHighRated(): bool
    {
        return $this->rating >= 4;
    }

    /**
     * Determine if the review is low rated (1 or 2 stars).
     */
    public function isLowRated(): bool
    {
        return $this->rating <= 2;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($review) {
            // Ensure rating is between 1 and 5
            if ($review->rating < 1) {
                $review->rating = 1;
            }
            if ($review->rating > 5) {
                $review->rating = 5;
            }
        });
    }
}