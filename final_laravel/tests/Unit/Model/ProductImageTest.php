<?php

namespace Tests\Unit\Model;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_first_url()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'image_path' => 'first.jpg',
            'alt_text' => 'First Image',
            'sort_order' => 1,
            'is_primary' => true,
            
        ]);
        $this->assertEquals('first.jpg', $image->getImagePath('first.jpg'));
    }

    public function test_it_returns_image_path()
    {
        $product = Product::factory()->create();
        $image = ProductImage::factory()->create([
            'product_id' => $product->id,
            'image_path' => 'test-image.jpg'
        ]);

        $this->assertEquals('test-image.jpg', $image->getImagePath());
    }
}