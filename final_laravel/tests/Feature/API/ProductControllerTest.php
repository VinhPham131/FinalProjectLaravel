<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestHelpers;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    public function test_can_view_products()
    {
        $this->createProduct();
        $this->createProduct();
        $this->createProduct();

        $response = $this->getJson('/api/product');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_product()
    {
        $product = $this->createProduct();

        $response = $this->getJson('/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $product->id]);
    }

    public function test_admin_can_create_product()
    {
        $collection = $this->createCollection();
        $category = $this->createProductCategory();

        $data = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 100,
            'quantity' => 10,
            'material' => 'Cotton',
            'size' => 'L',
            'stylecode' => 'SC123',
            'collection_id' => $collection->id,
            'productcode' => 'PC123',
            'color' => 'Red',
            'category_id' => $category->id,
        ];

        $response = $this->actingAsAdmin()->postJson('/api/product', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Product']);
    }

    public function test_admin_can_update_product()
    {
        $product = $this->createProduct();
        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 150,
            'quantity' => 20,
            'material' => 'Wool',
            'size' => 'M',
            'stylecode' => 'SC456',
            'collection_id' => $product->collection_id,
            'productcode' => 'PC456',
            'color' => 'Blue',
            'category_id' => $product->category_id,
        ];

        $response = $this->actingAsAdmin()->putJson('/api/product/' . $product->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Product']);
    }

    public function test_admin_can_delete_product()
    {
        $product = $this->createProduct();

        $response = $this->actingAsAdmin()->deleteJson('/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Product deleted successfully.']);
    }

    public function test_non_admin_cannot_create_product()
    {
        $data = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 100,
            'quantity' => 10,
            'material' => 'Cotton',
            'size' => 'L',
            'stylecode' => 'SC123',
            'collection_id' => 1,
            'productcode' => 'PC123',
            'color' => 'Red',
            'category_id' => 1,
        ];

        $response = $this->actingAsUser()->postJson('/api/product', $data);

        $response->assertStatus(403);
    }
}
