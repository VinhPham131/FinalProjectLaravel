<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contact;


class ContactTest extends TestCase
{
   use RefreshDatabase;
    public function test_it_able_to_create_contact()
    {
        $contact = Contact::factory()->create();

        $this->assertDatabaseHas('contacts', [
            'name' => $contact->name,
            'email' => $contact->email,
            'message' => $contact->message,
        ]);
    }
    public function test_it_able_to_get_contact()
    {
        $contact = Contact::factory()->create();

        $this->assertInstanceOf(Contact::class, $contact);
    }
}
