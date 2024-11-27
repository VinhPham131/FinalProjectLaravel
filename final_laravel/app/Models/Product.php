<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;
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
            ->orWhere('name', $this->collection)->get();
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

