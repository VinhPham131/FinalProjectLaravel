<?php

namespace Tests\Feature\API;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_sales()
    {
        Sale::factory()->count(3)->create();

        $response = $this->getJson('/api/sale');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_sale()
    {
        $sale = Sale::factory()->create();

        $response = $this->getJson('/api/sale/' . $sale->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $sale->id]);
    }

    public function test_admin_can_create_sale()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $data = [
            'name' => 'New Sale',
            'sale_target_type' => 'product',
            'sale_target_id' => 1,
            'percentage' => 20,
            'start_date' => '2024-12-31',
            'end_date' => '2024-12-31',
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/sale', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Sale']);
    }

    public function test_admin_can_update_sale()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $sale = Sale::factory()->create();
        $data = [
            'name' => 'Updated Sale',
            'sale_target_type' => 'product',
            'sale_target_id' => 1,
            'percentage' => 30,
            'start_date' => '2024-12-31',
            'end_date' => '2024-12-31',
        ];

        $response = $this->actingAs($admin, 'sanctum')->putJson('/api/sale/' . $sale->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Sale']);
    }
    public function test_admin_can_delete_sale()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $sale = Sale::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson('/api/sale/' . $sale->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Sale deleted successfully']);
    }

    public function test_non_admin_cannot_create_sale()
    {
        $user = User::factory()->create(['role' => 'user']);
        $data = [
            'name' => 'New Sale',
            'sale_target_type' => 'product',
            'sale_target_id' => 1,
            'percentage' => 20,
            'start_date' => '2024-12-31',
            'end_date' => '2024-12-31',
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/sale', $data);

        $response->assertStatus(403);
    }
}
