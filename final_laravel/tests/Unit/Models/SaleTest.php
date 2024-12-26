<?php

namespace Tests\Unit\Models;

use App\Models\ProductCategory;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_able_to_get_category() {
        $category = ProductCategory::factory()->create();
        $sale = Sale::factory()->create([
            'name' => $category->name,
        ]);

        $this->assertInstanceOf(ProductCategory::class, $sale->category);
        $this->assertEquals($category->name, $sale->category->name);
    }
}
