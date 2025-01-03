<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'material',
        'size',
        'stylecode',
        'collection_id',
        'productcode',
        'color',
        'category_id',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function cartItem()
    {
        return $this->hasMany(CartsItem::class, 'product_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'sale_target_id')->where('sale_target_type', 'product');
    }
    public function order()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
    // Function to get the primary image or first image
    public function getPrimaryImagePath()
    {
        $primaryImage = $this->images->firstWhere('is_primary', true) ?? $this->images->first();
        if ($primaryImage) {
            $imagePath = $primaryImage->image_path;
            return filter_var($imagePath, FILTER_VALIDATE_URL) ? $imagePath : asset($imagePath);
        }
        return asset('images/placeholder.png'); // Fallback image
    }

    // Accessor for the highest sale percentage
    public function getHighestSalePercentageAttribute()
    {
        // Check if we already have the highest sale percentage cached
        if (!isset($this->attributes['highest_sale_percentage'])) {
            $this->attributes['highest_sale_percentage'] = $this->getAllSales()->max('percentage');
        }

        return $this->attributes['highest_sale_percentage'];
    }

    // Function to calculate the sale price based on the highest sale percentage
    public function salePrice()
    {
        return $this->highest_sale_percentage ? $this->price * (1 - $this->highest_sale_percentage / 100) : null;
    }

    // Function to get all active sales for the product
    public function getAllSales()
    {
        $currentDate = now();

        return Sale::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->where(function ($query) {
                $query->where('sale_target_type', 'product')
                    ->where('sale_target_id', $this->id)
                    ->orWhere(function ($query) {
                        $query->where('sale_target_type', 'category')
                            ->where('sale_target_id', $this->category_id);
                    })
                    ->orWhere(function ($query) {
                        $query->where('sale_target_type', 'collection')
                            ->where('sale_target_id', $this->collection_id);
                    });
            })
            ->get();
    }

    public function relatedProducts()
    {
        return Product::where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->orWhere('category_id', $this->category_id);
                $query->orWhere('collection_id', $this->collection_id);
                $query->orWhereHas('sales', function ($saleQuery) {
                    $saleQuery->where('percentage', $this->highestSale());
                });
            })
            ->take(5)
            ->get();
    }

    public function getRouteKeyName(): string
    {
        return is_numeric(request()->route('product')) ? 'id' : 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')
            ->useDisk('public');
    }
}
