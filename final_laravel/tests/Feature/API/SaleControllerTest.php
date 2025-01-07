<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestHelpers;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    public function test_can_view_sales()
    {
        $this->createSale();
        $this->createSale();
        $this->createSale();

        $response = $this->getJson('/api/sale');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_sale()
    {
        $sale = $this->createSale();

        $response = $this->getJson('/api/sale/' . $sale->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $sale->id]);
    }

    public function test_admin_can_create_sale()
    {
        $admin = $this->createAdmin();
        $product = $this->createProduct();

        $data = [
            'name' => 'New Sale',
            'sale_target_type' => 'product',
            'sale_target_id' => $product->id,
            'percentage' => 20,
            'start_date' => now()->subDay()->toDateTimeString(),
            'end_date' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/sale', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Sale']);
    }

    public function test_admin_can_update_sale()
    {
        $sale = $this->createSale();
        $data = [
            'name' => 'Updated Sale',
            'percentage' => 30,
            'start_date' => now()->subDay()->toDateTimeString(),
            'end_date' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->actingAsAdmin()->putJson('/api/sale/' . $sale->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Sale']);
    }

    public function test_admin_can_delete_sale()
    {
        $sale = $this->createSale();

        $response = $this->actingAsAdmin()->deleteJson('/api/sale/' . $sale->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Sale deleted successfully']);
    }

    public function test_non_admin_cannot_create_sale()
    {
        $data = [
            'name' => 'New Sale',
            'percentage' => 20,
            'start_date' => now()->subDay()->toDateTimeString(),
            'end_date' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->actingAsUser()->postJson('/api/sale', $data);

        $response->assertStatus(403);
    }
}
