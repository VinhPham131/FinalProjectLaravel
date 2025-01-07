<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Livewire;
use App\Livewire\FilteredProducts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterTest extends TestCase
{
    use RefreshDatabase;

    private function createProduct($attributes = [])
    {
        return Product::factory()->create($attributes);
    }

    private function createCategory()
    {
        return ProductCategory::factory()->create();
    }

    private function createSale($attributes = [])
    {
        return Sale::factory()->create($attributes);
    }

    public function test_it_filters_products_by_search_term()
    {
        $productA = $this->createProduct(['name' => 'Product A']);
        $productB = $this->createProduct(['name' => 'Product B']);

        Livewire::test(FilteredProducts::class)
            ->set('search', 'Product A')
            ->assertSet('search', 'Product A')
            ->assertSee($productA->name)
            ->assertDontSee($productB->name);
    }

    public function test_it_filters_products_by_category()
    {
        $categoryA = $this->createCategory();
        $categoryB = $this->createCategory();

        $productA = $this->createProduct(['category_id' => $categoryA->id]);
        $productB = $this->createProduct(['category_id' => $categoryB->id]);

        Livewire::test(FilteredProducts::class)
            ->set('selectedCategories', [$categoryA->id])
            ->assertSet('selectedCategories', [$categoryA->id])
            ->assertSee($productA->name)
            ->assertDontSee($productB->name);
    }

    public function test_it_filters_products_on_sale()
    {
        $category = $this->createCategory();
        $sale = $this->createSale([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
        ]);
        $productOnSale = $this->createProduct(['category_id' => $category->id, 'name' => 'On Sale']);
        $productNotOnSale = $this->createProduct(['name' => 'Not On Sale']);

        Livewire::test(FilteredProducts::class)
            ->set('onSale', true)
            ->assertSet('onSale', true)
            ->assertSee($productOnSale->name)
            ->assertDontSee($productNotOnSale->name);
    }

    public function test_it_filters_products_in_stock()
    {
        $productInStock = $this->createProduct(['quantity' => 10]);
        $productOutOfStock = $this->createProduct(['quantity' => 0]);

        Livewire::test(FilteredProducts::class)
            ->set('inStock', true)
            ->assertSet('inStock', true)
            ->assertSee($productInStock->name)
            ->assertDontSee($productOutOfStock->name);
    }

    public function test_it_sorts_products_by_price_ascending()
    {
        $productCheap = $this->createProduct(['price' => 10]);
        $productExpensive = $this->createProduct(['price' => 100]);

        Livewire::test(FilteredProducts::class)
            ->set('sortBy', 'lowest_to_highest')
            ->assertSet('sortBy', 'lowest_to_highest')
            ->assertSeeInOrder([$productCheap->name, $productExpensive->name]);
    }

    public function test_it_sorts_products_by_price_descending()
    {
        $productCheap = $this->createProduct(['price' => 10]);
        $productExpensive = $this->createProduct(['price' => 100]);

        Livewire::test(FilteredProducts::class)
            ->set('sortBy', 'highest_to_lowest')
            ->assertSet('sortBy', 'highest_to_lowest')
            ->assertSeeInOrder([$productExpensive->name, $productCheap->name]);
    }
}
