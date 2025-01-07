<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Collection;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_retrieve_category()
    {
        $category = ProductCategory::factory()->create();
        $sale = Sale::factory()->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
        ]);

        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
        ]);
    }

    public function test_it_can_retrieve_collection()
    {
        $collection = Collection::factory()->create();
        $sale = Sale::factory()->create([
            'sale_target_type' => 'collection',
            'sale_target_id' => $collection->id,
        ]);

        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'sale_target_type' => 'collection',
            'sale_target_id' => $collection->id,
        ]);
    }

    public function test_it_can_retrieve_product()
    {
        $product = Product::factory()->create();
        $sale = Sale::factory()->create([
            'sale_target_type' => 'product',
            'sale_target_id' => $product->id,
        ]);

        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'sale_target_type' => 'product',
            'sale_target_id' => $product->id,
        ]);
    }
}


