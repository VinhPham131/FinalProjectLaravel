<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestHelpers;

class ProductCategoryControllerTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    public function test_can_view_product_categories()
    {
        $this->createProductCategory();
        $this->createProductCategory();
        $this->createProductCategory();

        $response = $this->getJson('/api/category');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_product_category()
    {
        $category = $this->createProductCategory();

        $response = $this->getJson('/api/category/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $category->id]);
    }

    public function test_admin_can_create_product_category()
    {
        $data = [
            'name' => 'New Category',
            'description' => 'Description of the new category',
        ];

        $response = $this->actingAsAdmin()->postJson('/api/category', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Category']);
    }

    public function test_admin_can_update_product_category()
    {
        $category = $this->createProductCategory();
        $data = [
            'name' => 'Updated Category',
            'description' => 'Updated description',
        ];

        $response = $this->actingAsAdmin()->putJson('/api/category/' . $category->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Category']);
    }

    public function test_admin_can_delete_product_category()
    {
        $category = $this->createProductCategory();

        $response = $this->actingAsAdmin()->deleteJson('/api/category/' . $category->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Category deleted successfully.']);
    }

    public function test_non_admin_cannot_create_product_category()
    {
        $data = [
            'name' => 'New Category',
            'description' => 'Description of the new category',
        ];

        $response = $this->actingAsUser()->postJson('/api/category', $data);

        $response->assertStatus(403);
    }
}
