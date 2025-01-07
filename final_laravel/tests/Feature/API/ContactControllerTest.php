<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestHelpers;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase, TestHelpers;

    public function test_admin_can_view_contacts()
    {
        $this->createContact();
        $this->createContact();
        $this->createContact();

        $response = $this->actingAsAdmin()->getJson('/api/contact');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_admin_can_view_single_contact()
    {
        $contact = $this->createContact();

        $response = $this->actingAsAdmin()->getJson('/api/contact/' . $contact->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $contact->id]);
    }

    public function test_admin_can_create_contact()
    {
        $data = [
            'name' => 'New Contact',
            'email' => 'contact@example.com',
            'message' => 'This is a new contact message.',
        ];

        $response = $this->actingAsAdmin()->postJson('/api/contact', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Contact']);
    }

    public function test_admin_can_update_contact()
    {
        $contact = $this->createContact();
        $data = [
            'name' => 'Updated Contact',
            'email' => 'updated@example.com',
            'message' => 'This is an updated contact message.',
        ];

        $response = $this->actingAsAdmin()->putJson('/api/contact/' . $contact->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Contact']);
    }

    public function test_admin_can_delete_contact()
    {
        $contact = $this->createContact();

        $response = $this->actingAsAdmin()->deleteJson('/api/contact/' . $contact->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Contact deleted successfully.']);
    }

    public function test_non_admin_cannot_create_contact()
    {
        $data = [
            'name' => 'New Contact',
            'email' => 'contact@example.com',
            'message' => 'This is a new contact message.',
        ];

        $response = $this->actingAsUser()->postJson('/api/contact', $data);

        $response->assertStatus(403);
    }
}
