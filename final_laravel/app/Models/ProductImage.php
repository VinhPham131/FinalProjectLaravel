<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['image_path', 'alt_text', 'sort_order', 'is_primary', 'product_id'];

    // Each image belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Helper to get the path (for display purposes).
     */
    public function getImagePath()
    {
        return $this->image_path ?? '/images/default-product.jpg'; // Return the image URL or a default image
    }
}
