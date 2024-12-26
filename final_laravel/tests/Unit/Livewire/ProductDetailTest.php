<?php

namespace Tests\Unit\Livewire;

use App\Livewire\ProductDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductDetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_product_details()
    {
        $category = ProductCategory::factory()->create(['name' => 'Electronics']);
        $product = Product::factory()->create([
            'price' => 100,
            'category_id' => $category->id,
        ]);

        Sale::factory()->create([
            'name' => $category->name,
            'percentage' => 20,
        ]);

        Livewire::test(ProductDetail::class, ['product' => $product])
            ->assertSee($product->name)
            ->assertSee($product->description)
            ->assertSee($product->price)
            ->assertSee($product->discounted_price)
            ->assertViewHas('relatedProducts'); 
    }
    /** @test */
    public function related_products_are_loaded_properly()
    {
        $category = ProductCategory::factory()->create(['name' => 'Electronics']);
        $mainProduct = Product::factory()->create([
            'name' => 'Main Product',
            'category_id' => $category->id,
        ]);

        $relatedProduct = Product::factory()->create([
            'name' => 'Related Product',
            'category_id' => $category->id,
        ]);

        Sale::factory()->create([
            'name' => $category->name,
            'percentage' => 15,
        ]);

        Livewire::test(ProductDetail::class, ['product' => $mainProduct])
            ->assertSee('Main Product')
            ->assertSee('Related Product');
    }
}
