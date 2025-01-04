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

    protected function createProductWithCategory($categoryName = 'Bracelet')
    {
        $category = ProductCategory::factory()->create(['name' => $categoryName]);
        return Product::factory()->create(['category_id' => $category->id]);
    }

    public function test_it_can_retrieve_category()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(ProductCategory::class, $product->category);
    }

    public function test_it_can_retrieve_collection()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(Collection::class, $product->collection);
    }

    public function test_it_can_retrieve_images()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create(['product_id' => $product->id]);
        $this->assertTrue($product->images->contains($image));
    }

    public function test_it_can_retrieve_applicable_sales()
    {
        $category = ProductCategory::factory()->create();
        $collection = Collection::factory()->create();

        $product = Product::factory()->create(['category_id' => $category->id, 'collection_id' => $collection->id]);

        $categorySale = Sale::factory()->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        $collectionSale = Sale::factory()->create([
            'sale_target_type' => 'collection',
            'sale_target_id' => $collection->id,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        $productSale = Sale::factory()->create([
            'sale_target_type' => 'product',
            'sale_target_id' => $product->id,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        $sales = $product->getAllSales();

        $this->assertTrue($sales->contains($categorySale));
        $this->assertTrue($sales->contains($collectionSale));
        $this->assertTrue($sales->contains($productSale));
    }


    public function test_it_can_calculate_highest_sales_percentage()
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        Sale::factory()->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
            'percentage' => 15,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        Sale::factory()->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
            'percentage' => 25,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        $this->assertEquals(25, $product->highest_sale_percentage);
    }

    public function test_it_can_calculate_sale_price()
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'price' => 200,
        ]);

        Sale::factory()->create([
            'sale_target_type' => 'category',
            'sale_target_id' => $category->id,
            'percentage' => 20,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        $this->assertEquals(160, $product->salePrice());
    }


    public function test_it_can_retrieve_primary_image_path()
    {
        $product = Product::factory()->create();

        $primaryImage = ProductImage::factory()->create([
            'product_id' => $product->id,
            'is_primary' => true,
            'image_path' => 'primary.jpg',
        ]);

        ProductImage::factory()->create([
            'product_id' => $product->id,
            'image_path' => 'secondary.jpg',
        ]);

        $this->assertEquals(asset('primary.jpg'), $product->getPrimaryImagePath());
    }


    public function test_it_can_retrieve_related_products()
    {
        $category = ProductCategory::factory()->create();
        $collection = Collection::factory()->create();

        $product = Product::factory()->create(['category_id' => $category->id, 'collection_id' => $collection->id]);

        $relatedProduct = Product::factory()->create(['category_id' => $category->id, 'collection_id' => $collection->id]);
        $unrelatedProduct = Product::factory()->create();

        $relatedProducts = $product->relatedProducts();

        $this->assertTrue($relatedProducts->contains($relatedProduct));
        $this->assertFalse($relatedProducts->contains($unrelatedProduct));
    }

}
