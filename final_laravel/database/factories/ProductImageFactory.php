<?php

namespace Database\Factories;

use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'urls' => json_encode([fake()->imageUrl()]),
            'product_id' => Product::factory()->create()->id,
        ];
    }
}
