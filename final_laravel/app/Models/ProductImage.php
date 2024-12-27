<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['urls', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Accessor to decode the JSON URLs.
     */
    public function getUrlsAttribute($value)
    {
        $decoded = json_decode($value, true);

        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        return $decoded;
    }

    /**
     * Mutator to encode the URLs as JSON.
     */
    public function setUrlsAttribute($value)
    {
        $this->attributes['urls'] = json_encode($value);
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
