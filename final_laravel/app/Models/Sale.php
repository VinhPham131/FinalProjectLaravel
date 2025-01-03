<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
'sale_target_type', // Product, category, or collection
        'sale_target_id', // Foreign key to product, category, or collection        'percentage',
        'start_date',
        'end_date',
    ];

    // Sale belongs to a category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'sale_target_id')->where('sale_target_type', 'category');
    }

    // Sale belongs to a collection
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'sale_target_id')->where('sale_target_type', 'collection');
    }

    // Sale belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'sale_target_id')->where('sale_target_type', 'product');
    }
}
