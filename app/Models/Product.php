<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Comment;
use Database\Factories\Shop\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model
{
    use HasFactory;

    use InteractsWithMedia;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'price',
        'delivery_charge',
        'type',
        'status',
        'thumbnail',
        'is_cod_available',
        'stock_count',
        'sku',
    ];


  
   

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product-images')
            ->acceptsMimeTypes(['image/jpeg'])
            ->registerMediaConversions(function (Media $media): void {
                $this
                    ->addMediaConversion('thumb')
                    ->width(40)
                    ->height(40);
            });
    }
    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
