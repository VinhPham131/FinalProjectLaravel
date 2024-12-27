<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use Sluggable, InteractsWithMedia;

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
        'sale_count',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('productImages')
            ->useDisk('public'); // Ensure the disk is set correctly
    }

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

    public function applicableSales()
    {
        return Sale::where('name', $this->category->name)
            ->orWhere('name', $this->collection->name)
            ->get();
    }

    public function highestSale()
    {
        $sales = $this->applicableSales();
        return $sales->max('percentage');
    }

    public function salePrice()
    {
        $highestSale = $this->highestSale();
        return $highestSale ? $this->price * (1 - $highestSale / 100) : $this->price;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
