<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_able_to_get_products()
    {
        $category = ProductCategory::factory()
            ->has(Product::factory()->count(3), 'products')
            ->create();
        $this->assertInstanceOf(Product::class, $category->products->random());
        $this->assertTrue(count($category->products) === 3);
    }
    public function test_it_able_to_get_sales()
    {
        $category = ProductCategory::factory()->create();

        Sale::factory()->count(3)->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
        ]);

        $this->assertInstanceOf(Sale::class, $category->sales->random());
        $this->assertTrue(count($category->sales) === 3);
    }
}