<?php

namespace Tests\Unit\Livewire;

use App\Models\ProductCategory;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Livewire;
use App\Livewire\FilteredProducts;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterFunctionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_filters_products_by_search_term()
    {
        $productA = Product::factory()->create(['name' => 'Product A']);
        $productB = Product::factory()->create(['name' => 'Product B']);

        Livewire::test(FilteredProducts::class)
            ->set('search', 'Product A')
            ->assertSee($productA->name)
            ->assertDontSee($productB->name);
    }

    /** @test */
    public function it_filters_products_by_category()
    {
        $categoryA = ProductCategory::factory()->create();
        $categoryB = ProductCategory::factory()->create();

        $productA = Product::factory()->create(['category_id' => $categoryA->id]);
        $productB = Product::factory()->create(['category_id' => $categoryB->id]);

        Livewire::test(FilteredProducts::class)
            ->set('selectedCategories', [$categoryA->id])
            ->assertSee($productA->name)
            ->assertDontSee($productB->name);
    }

    /** @test */
    public function it_filters_products_on_sale()
    {
        $category = ProductCategory::factory()->create();
        $sale = Sale::factory()->create(['name' => $category->name, 'percentage' => 10, 'sale_target' => 'category']);

        $productOnSale = Product::factory()->create(['category_id' => $category->id]);
        $productNotOnSale = Product::factory()->create();

        Livewire::test(FilteredProducts::class)
            ->set('onSale', true)
            ->assertSee($productOnSale->name)
            ->assertDontSee($productNotOnSale->name);
    }

    /** @test */
    public function it_filters_products_in_stock()
    {
        $productInStock = Product::factory()->create(['quantity' => 10]);
        $productOutOfStock = Product::factory()->create(['quantity' => 0]);

        Livewire::test(FilteredProducts::class)
            ->set('inStock', true)
            ->assertSee($productInStock->name)
            ->assertDontSee($productOutOfStock->name);
    }

    /** @test */
    public function it_sorts_products_by_price_ascending()
    {
        $productCheap = Product::factory()->create(['price' => 10]);
        $productExpensive = Product::factory()->create(['price' => 100]);

        Livewire::test(FilteredProducts::class)
            ->set('sortBy', 'lowest_to_highest')
            ->assertSeeInOrder([$productCheap->name, $productExpensive->name]);
    }

    /** @test */
    public function it_sorts_products_by_price_descending()
    {
        $productCheap = Product::factory()->create(['price' => 10]);
        $productExpensive = Product::factory()->create(['price' => 100]);

        Livewire::test(FilteredProducts::class)
            ->set('sortBy', 'highest_to_lowest')
            ->assertSeeInOrder([$productExpensive->name, $productCheap->name]);
    }

    /** @test */
    public function it_sorts_products_by_best_seller()
    {
        $productLowSales = Product::factory()->create(['sale_count' => 10]);
        $productHighSales = Product::factory()->create(['sale_count' => 100]);

        Livewire::test(FilteredProducts::class)
            ->set('sortBy', 'best_seller')
            ->assertSeeInOrder([$productHighSales->name, $productLowSales->name]);
    }
}