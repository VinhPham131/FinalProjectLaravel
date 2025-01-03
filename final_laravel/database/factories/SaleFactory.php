<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'sale_target_type' => $this->faker->randomElement(['product', 'category', 'collection']),
            'sale_target_id' => function (array $attributes) {
                switch ($attributes['sale_target_type']) {
                    case 'product':
                        return Product::factory()->create()->id;
                    case 'category':
                        return ProductCategory::factory()->create()->id;
                    case 'collection':
                        return Collection::factory()->create()->id;
                }
            },
            'percentage' => $this->faker->randomFloat(2, 0, 100),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
