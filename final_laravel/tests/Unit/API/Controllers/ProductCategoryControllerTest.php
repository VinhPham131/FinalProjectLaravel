<?php

namespace Tests\Feature;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_product_categories()
    {
        ProductCategory::factory()->count(3)->create();

        $response = $this->getJson('/api/category');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_product_category()
    {
        $category = ProductCategory::factory()->create();

        $response = $this->getJson('/api/category/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $category->id]);
    }

    public function test_admin_can_create_product_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $data = [
            'name' => 'New Category',
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/category', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Category']);
    }

    public function test_admin_can_update_product_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = ProductCategory::factory()->create();
        $data = [
            'name' => 'Updated Category',
        ];

        $response = $this->actingAs($admin, 'sanctum')->putJson('/api/category/' . $category->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Category']);
    }

    public function test_admin_can_delete_product_category()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = ProductCategory::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson('/api/category/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Category deleted successfully.']);
    }

    public function test_non_admin_cannot_create_product_category()
    {
        $user = User::factory()->create(['role' => 'user']);
        $data = [
            'name' => 'New Category',
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/category', $data);

        $response->assertStatus(403);
    }
}
