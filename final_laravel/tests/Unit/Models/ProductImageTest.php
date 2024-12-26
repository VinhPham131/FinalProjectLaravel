<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_able_to_get_product_images()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'urls' => json_encode(['test.jpg'])
        ]);

        $this->assertInstanceOf(ProductImage::class, $image);
        $this->assertEquals($product->id, $image->product_id);
    }

    public function test_it_able_to_get_urls_attributes()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'urls' => json_encode(['vinh.jpg', 'second.jpg'])
        ]);

        $this->assertInstanceOf(ProductImage::class, $image);
        $this->assertEquals($product->id, $image->product_id);
        $this->assertIsArray($image->urls);
        $this->assertEquals(['vinh.jpg', 'second.jpg'], $image->urls);
    }
    public function test_it_able_to_set_urls_attributes()
{
    $product = Product::factory()->create();

    $image = new ProductImage([
        'product_id' => $product->id,
        'urls' => ['image1.jpg', 'image2.jpg']
    ]);
    $image->save();

    $freshImage = ProductImage::find($image->id);

    $this->assertEquals(['image1.jpg', 'image2.jpg'], $freshImage->urls);
}


    public function test_it_returns_first_url_correctly()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'urls' => json_encode(['first.jpg', 'second.jpg'])
        ]);

        $this->assertEquals('first.jpg', $image->first_url);
    }

    public function test_it_returns_default_url_if_no_urls()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'urls' => json_encode([])
        ]);

        $this->assertEquals('/images/default-product.jpg', $image->first_url);
    }
}
