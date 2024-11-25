<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'quantity',
        'material',
        'size',
        'stylecode',
        'collection',
        'productcode',
        'color',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'name', 'name');
    }
}

