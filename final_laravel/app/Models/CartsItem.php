<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CartsItem extends Model
{
    use HasFactory;
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