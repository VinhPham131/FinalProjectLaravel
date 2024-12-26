<?php
namespace Database\Factories;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;
use App\Models\Sale;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'name' => ProductCategory::factory()->create()->name,
            'sale_target' => ProductCategory::factory()->create()->name,
            'percentage' => $this->faker->numberBetween(1, 99),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
        ];
    }
}