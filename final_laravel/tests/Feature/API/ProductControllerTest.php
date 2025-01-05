<?php

namespace Tests\Feature\API;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/product');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $product->id]);
    }

    public function test_admin_can_create_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = ProductCategory::factory()->create();
        $data = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 100.00,
            'quantity' => 10,
            'material' => 'Cotton',
            'size' => 'L',
            'stylecode' => 'SC123',
            'collection_id' => null,
            'productcode' => 'PC123',
            'color' => 'Red',
            'category_id' => $category->id,
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/product', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Product']);
    }

    public function test_admin_can_update_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create();
        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 150.00,
            'quantity' => 5,
            'material' => 'Wool',
            'size' => 'M',
            'stylecode' => 'SC456',
            'collection_id' => $product->collection_id,
            'productcode' => 'PC456',
            'color' => 'Blue',
            'category_id' => $product->category_id,
        ];

        $response = $this->actingAs($admin, 'sanctum')->putJson('/api/product/' . $product->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Product']);
    }

    public function test_admin_can_delete_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson('/api/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Product deleted successfully.']);
    }

    public function test_non_admin_cannot_create_product()
    {
        $user = User::factory()->create(['role' => 'user']);
        $category = ProductCategory::factory()->create();
        $data = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 100.00,
            'quantity' => 10,
            'material' => 'Cotton',
            'size' => 'L',
            'stylecode' => 'SC123',
            'collection_id' => null,
            'productcode' => 'PC123',
            'color' => 'Red',
            'category_id' => $category->id,
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/product', $data);

        $response->assertStatus(403);
    }
}
