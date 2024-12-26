<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        
        return [
            'name' => fake()->sentence(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(10, 1000),
            'quantity' => fake()->numberBetween(1, 100),
            'material' => 'Cotton',
            'size' => 'M',
            'stylecode' => 'SC123',
            'collection_id' => Collection::factory(),
            'productcode' => fake()->unique()->regexify('[A-Z0-9]{5}'),
            'color' => fake()->colorName(),
            'category_id' => ProductCategory::factory(),
            'slug' => fake()->slug(),
            'sale_count' => fake()->numberBetween(0, 100),
        ];
    }
}
