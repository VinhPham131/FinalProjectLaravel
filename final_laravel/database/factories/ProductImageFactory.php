<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'image_path' => $this->faker->imageUrl(),
            'alt_text' => $this->faker->sentence,
            'sort_order' => $this->faker->numberBetween(1, 10),
            'is_primary' => $this->faker->boolean,
        ];
    }
}