<?php

namespace Tests\Feature\API;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_contacts()
    {
        Contact::factory()->count(3)->create();

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/contact');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_admin_can_view_single_contact()
    {
        $contact = Contact::factory()->create();

        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/contact/' . $contact->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $contact->id]);
    }

    public function test_admin_can_create_contact()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $data = [
            'name' => 'Rizzler Test',
            'email' => 'rizz@test.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/contact', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Rizzler Test']);
    }

    public function test_admin_can_update_contact()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $contact = Contact::factory()->create();
        $data = [
            'name' => 'Rizzler Test',
            'email' => 'rizzler@example.com',
            'message' => 'This is an updated test message.',
        ];

        $response = $this->actingAs($admin, 'sanctum')->putJson('/api/contact/' . $contact->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Rizzler Test']);
    }

    public function test_admin_can_delete_contact()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $contact = Contact::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')->deleteJson('/api/contact/' . $contact->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Contact deleted successfully.']);
    }

    public function test_non_admin_cannot_create_contact()
    {
        $user = User::factory()->create(['role' => 'user']);
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/contact', $data);

        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_update_contact()
    {
        $user = User::factory()->create(['role' => 'user']);
        $contact = Contact::factory()->create();
        $data = [
            'name' => 'Rizzler Test',
            'email' => 'rizzler@example.com',
            'message' => 'This is an updated test message.',
        ];

        $response = $this->actingAs($user, 'sanctum')->putJson('/api/contact/' . $contact->id, $data);

        $response->assertStatus(403);
    }

    public function test_non_admin_cannot_delete_contact()
    {
        $user = User::factory()->create(['role' => 'user']);
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->deleteJson('/api/contact/' . $contact->id);

        $response->assertStatus(403);
    }
}
