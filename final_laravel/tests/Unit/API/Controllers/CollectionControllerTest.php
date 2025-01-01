<?php

namespace Tests\Feature;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_collections()
    {
        Collection::factory()->count(3)->create();

        $response = $this->getJson('/api/collection');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_collection()
    {
        $collection = Collection::factory()->create();

        $response = $this->getJson('/api/collection/' . $collection->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $collection->id]);
    }

    public function test_admin_can_create_collection()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $data = [
            'name' => 'New Collection',
            'description' => 'Description of the new collection',
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/collection', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Collection']);
    }

    public function test_admin_can_update_collection()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $collection = Collection::factory()->create();
        $data = [
            'name' => 'Updated Collection',
            'description' => 'Updated description',
        ];

        $response = $this->actingAs($admin, 'sanctum')->putJson('/api/collection/' . $collection->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Collection']);
    }

    public function test_admin_can_delete_collection()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $collection = Collection::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson('/api/collection/' . $collection->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Collection deleted successfully']);
    }

    public function test_non_admin_cannot_create_collection()
    {
        $user = User::factory()->create(['role' => 'user']);
        $data = [
            'name' => 'New Collection',
            'description' => 'Description of the new collection',
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/collection', $data);

        $response->assertStatus(403);
    }
}
