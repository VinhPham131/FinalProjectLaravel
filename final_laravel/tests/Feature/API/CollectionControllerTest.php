<?php

namespace Tests\Feature\API;

use App\Models\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestHelpers;

class CollectionControllerTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    public function test_can_view_collections()
    {
        Collection::factory()->count(3)->create();

        $response = $this->getJson('/api/collection');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_view_single_collection()
    {
        $collection = $this->createCollection();

        $response = $this->getJson('/api/collection/' . $collection->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $collection->id]);
    }

    public function test_admin_can_create_collection()
    {
        $data = [
            'name' => 'New Collection',
            'description' => 'Description of the new collection',
        ];

        $response = $this->actingAsAdmin()->postJson('/api/collection', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Collection']);
    }

    public function test_admin_can_update_collection()
    {
        $collection = $this->createCollection();
        $data = [
            'name' => 'Updated Collection',
            'description' => 'Updated description',
        ];

        $response = $this->actingAsAdmin()->putJson('/api/collection/' . $collection->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Collection']);
    }

    public function test_admin_can_delete_collection()
    {
        $collection = $this->createCollection();

        $response = $this->actingAsAdmin()->deleteJson('/api/collection/' . $collection->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Collection deleted successfully']);
    }

    public function test_non_admin_cannot_create_collection()
    {
        $data = [
            'name' => 'New Collection',
            'description' => 'Description of the new collection',
        ];

        $response = $this->actingAsUser()->postJson('/api/collection', $data);

        $response->assertStatus(403);
    }
}
