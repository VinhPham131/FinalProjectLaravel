<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\CartsItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Listeners\MergeCartOnLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CartServiceTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        Session::start(); // Start session for testing guest cart
    }

    public function test_add_to_cart_authenticated_user()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create(['price' => 100]);

        $cart = new \App\Livewire\Cart();
        $cart->addToCart($product->id);

        $this->assertDatabaseHas('carts_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    public function test_add_to_cart_guest_user()
    {
        Session::put('cart', []);
        $product = Product::factory()->create(['price' => 100]);

        $cart = new \App\Livewire\Cart();
        $cart->addToCart($product->id);

        $sessionCart = Session::get('cart');
        $this->assertArrayHasKey($product->id, $sessionCart);
        $this->assertEquals(1, $sessionCart[$product->id]);
    }

    public function test_update_quantity_authenticated_user()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create(['price' => 100]);
        CartsItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 1]);

        $cart = new \App\Livewire\Cart();
        $cart->updateQuantity($product->id, 'increase');

        $this->assertDatabaseHas('carts_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }
    public function test_remove_item_from_cart_authenticated_user()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create(['price' => 100]);
        CartsItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 1]);

        $cart = new \App\Livewire\Cart();
        $cart->removeFromCart($product->id);

        $this->assertDatabaseMissing('carts_items', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    public function test_calculate_totals()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product1 = Product::factory()->create(['price' => 100]);
        $product2 = Product::factory()->create(['price' => 200]);

        CartsItem::create(['user_id' => $user->id, 'product_id' => $product1->id, 'quantity' => 2]);
        CartsItem::create(['user_id' => $user->id, 'product_id' => $product2->id, 'quantity' => 1]);

        $cart = new \App\Livewire\Cart();
        $cart->loadCart();

        $this->assertEquals(400, $cart->total); // (100 * 2) + (200 * 1)
        $this->assertEquals(3, $cart->totalQuantity);
    }
    public function test_guest_cart_merges_with_user_cart_on_login()
    {
        // Create a user and a product
        $user = User::factory()->create();
        $product1 = Product::factory()->create(['price' => 100]);
        $product2 = Product::factory()->create(['price' => 200]);

        // Simulate guest cart in session
        Session::put('cart', [
            $product1->id => 2, // Guest added 2 units of product1
            $product2->id => 1  // Guest added 1 unit of product2
        ]);

        // Simulate user already having 1 unit of product1 in their cart
        CartsItem::create([
            'user_id' => $user->id,
            'product_id' => $product1->id,
            'quantity' => 1
        ]);

        // Fire the Login event with the MergeCartOnLogin listener
        $listener = new MergeCartOnLogin();
        $listener->handle(new Login('web', $user, false));

        // Assert that the guest cart has been cleared
        $this->assertEmpty(Session::get('cart'));

        // Assert the merged quantities in the database
        $this->assertDatabaseHas('carts_items', [
            'user_id' => $user->id,
            'product_id' => $product1->id,
            'quantity' => 3 // 1 existing + 2 from guest cart
        ]);

        $this->assertDatabaseHas('carts_items', [
            'user_id' => $user->id,
            'product_id' => $product2->id,
            'quantity' => 1 // From guest cart
        ]);
    }

    public function test_guest_cart_is_cleared_after_merge()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 150]);

        // Simulate guest cart
        Session::put('cart', [
            $product->id => 1
        ]);

        $listener = new MergeCartOnLogin();
        $listener->handle(new Login('web', $user, false));

        $this->assertEmpty(Session::get('cart'));
    }

    public function test_no_action_if_guest_cart_is_empty()
    {
        $user = User::factory()->create();

        // Ensure guest cart is empty
        Session::put('cart', []);

        $listener = new MergeCartOnLogin();
        $listener->handle(new Login('web', $user, false));

        // Assert no cart items were added
        $this->assertDatabaseMissing('carts_items', [
            'user_id' => $user->id
        ]);

        // Assert guest cart remains empty
        $this->assertEmpty(Session::get('cart'));
    }
}
