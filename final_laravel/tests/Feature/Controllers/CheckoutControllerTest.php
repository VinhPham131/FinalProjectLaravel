<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\CartsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;


class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_it_shows_checkout_step()
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        session([
            'checkout' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'country' => 'USA',
                'address' => '123 Main St',
                'phone' => '123456789',
                'note' => 'Please deliver fast',
                'payment' => 'Bank Transfer',
            ]
        ]);

        $response = $this->actingAs($this->user)
            ->get(route('checkout.step', ['step' => 1]));

        $response->assertStatus(200);
        $response->assertViewIs('checkout');
        $response->assertViewHas(['step', 'cart', 'totalPrice']);
    }

    public function test_it_redirects_if_invalid_step()
    {
        $response = $this->actingAs($this->user)->get(route('checkout.step', ['step' => 5]));

        $response->assertStatus(404);
    }

    public function test_it_processes_step_one_successfully()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'country' => 'USA',
            'address' => '123 Main St',
            'phone' => '123456789',
            'note' => 'Please deliver fast',
            'payment' => 'Bank Transfer',

        ];

        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->post(route('checkout.process', ['step' => 1]), $data);
        $response->assertRedirect(route('checkout.process', ['step' => 2]));
        $this->assertEquals(session('checkout')['email'], 'john@example.com');
    }

    public function test_it_processes_step_two_and_creates_order()
    {
        // Step 1 data in session
        session([
            'checkout' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'country' => 'USA',
                'address' => '123 Main St',
                'phone' => '123456789',
                'note' => 'Please deliver fast',
                'payment' => 'Bank Transfer',
            ]
        ]);

        // Add items to the cart
        CartsItem::factory()->count(2)->create(['user_id' => $this->user->id]);

        // Ensure cart items exist
        $this->assertDatabaseCount('carts_items', 2);

        // Process step 2
        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->post(route('checkout.process', ['step' => 2]));

        $response->assertRedirect(route('checkout.process', ['step' => 3]));

        // Verify order creation
        $this->assertDatabaseHas('orders', ['user_id' => $this->user->id]);
        $this->assertDatabaseCount('order_items', 2);
    }
    public function test_it_throws_error_if_cart_is_empty_in_step_two()
    {
        session([
            'checkout' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'country' => 'USA',
                'address' => '123 Main St',
                'phone' => '123456789',
                'note' => 'Please deliver fast',
                'payment' => 'Bank Transfer',
            ]
        ]);

        $response = $this->withoutMiddleware()
            ->actingAs($this->user)
            ->post(route('checkout.process', ['step' => 2]));
        $response->assertRedirect(route('checkout.step', ['step' => 2]));
        $response->assertSessionHas('error', 'An error occurred. Please try again.');
    }

    public function test_it_redirects_to_step_two_if_order_does_not_exist_for_step_three()
    {
        $response = $this->actingAs($this->user)->get(route('checkout.step', ['step' => 3]));

        $response->assertRedirect(route('checkout.step', ['step' => 2]));
        $response->assertSessionHas('error', 'You must create an order before proceeding to step 3.');
    }
}
