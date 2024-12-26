<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Collection;
use App\Models\ProductImage;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_able_to_get_category()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(ProductCategory::class, $product->category);
    }
    public function test_it_able_to_get_collection()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(Collection::class, $product->collection);
    }
    public function test_it_able_to_get_images()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create(['product_id' => $product->id]);
        $this->assertInstanceOf(ProductImage::class, $product->images->first());
    }
    public function test_it_able_to_get_applicable_sales(){
        $category = ProductCategory::factory()->create(['name' => 'Bracelet']);
        $collection = Collection::factory()->create(['name'=> 'Winter Collection']);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'collection_id' => $collection->id,
        ]);
    
        Sale::factory()->create(['name' => 'Bracelet', 'percentage' => 10]);
        Sale::factory()->create(['name' => 'Winter Collection', 'percentage' => 20]);
    
        $sales = $product->applicableSales();
    
        $this->assertCount(2, $sales);
        $this->assertEquals(20, $sales->max('percentage'));
    }
    public function test_it_able_to_calculate_highest_sales(){
        $category = ProductCategory::factory()->create(['name'=> 'Bracelet']);
        $collection = Collection::factory()->create(['name'=> 'Winter Collection']);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'collection_id' => $collection->id,
        ]);
        $highestSale = $product->highestSale();
        $this->assertEquals(0, $highestSale);
    }
    public function test_it_able_to_calculate_sale_price(){
        $category = ProductCategory::factory()->create(['name'=> 'Bracelet']);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 1000,
        ]);
        Sale::factory()->create(['name' => 'Bracelet', 'sale_target' => 'category', 'percentage' => 10]);
        $salePrice = $product->salePrice();
        $this->assertEquals(900, $salePrice);
    }
}
