<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'material' => $this->faker->word,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'stylecode' => $this->faker->bothify('SC###'),
            'collection_id' => Collection::factory(),
            'productcode' => $this->faker->unique()->bothify('PC###'),
            'color' => $this->faker->safeColorName,
            'category_id' => ProductCategory::factory(),
        ];
    }
}
