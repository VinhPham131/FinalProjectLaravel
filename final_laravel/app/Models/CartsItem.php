<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartsItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getPriceAttribute()
    {
        return $this->product->salePrice();
    }
    
    public function getTotalPriceAttribute()
    {
        return $this->product->salePrice() * $this->quantity;
    }
}