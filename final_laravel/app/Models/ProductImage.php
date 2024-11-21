<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['urls', 'product_id'];

    /**
     * Relationship with Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor to decode the JSON URLs.
     */
    public function getUrlsAttribute($value)
    {
        return json_decode($value, true); 
    }

    /**
     * Helper to get the first URL (for display purposes).
     */
    public function getFirstUrlAttribute()
    {
        $urls = $this->urls; // Access the decoded JSON
        return $urls ? $urls[0] : '/images/default-product.jpg'; // Return the first URL or a default image
    }
}


