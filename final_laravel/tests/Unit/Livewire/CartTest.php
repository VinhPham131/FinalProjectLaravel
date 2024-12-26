<?php

namespace Tests\Unit\Livewire;

use App\Livewire\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_cart_component_correctly()
    {
        // Arrange: Create a product and simulate adding it to the cart
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
        ]);

        session()->put('cart', [
            $product->id => [
                'name' => $product->name,
                'price' => 90, 
                'original_price' => 100,
                'discount_percentage' => 10,
                'image' => asset('images/placeholder.png'),
                'quantity' => 1,
            ],
        ]);

        // Act & Assert: Ensure the component renders correctly
        Livewire::test(Cart::class)
            ->assertSee('Test Product')
            ->assertSee('$90.00')
            ->assertSee('$100.00')
            ->assertSee('(10% OFF)')
            ->assertSee('Total: $90.00')
            ->assertSee('1');
    }

    /** @test */
    public function it_shows_notification_when_product_is_added()
    {
        // Arrange: Create a product
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
        ]);

        // Act: Add product to cart
        Livewire::test(Cart::class)
            ->call('addToCart', $product->id)
            ->assertDispatched('cart-updated', message: "{$product->name} added to cart.");
    }

    /** @test */
    public function it_can_increase_product_quantity()
    {
        // Arrange: Create a product and add it to cart
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
        ]);

        session()->put('cart', [
            $product->id => [
                'name' => $product->name,
                'price' => 100,
                'original_price' => 100,
                'discount_percentage' => 10,
                'image' => asset('images/placeholder.png'),
                'quantity' => 1,
            ],
        ]);

        // Act: Increase quantity
        Livewire::test(Cart::class)
            ->call('updateQuantity', $product->id, 'increase');

        // Assert: Quantity increased
        $this->assertEquals(2, session('cart')[$product->id]['quantity']);
    }

    /** @test */
    public function it_can_decrease_product_quantity()
    {
        // Arrange: Add product with quantity 2
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
        ]);

        session()->put('cart', [
            $product->id => [
                'name' => $product->name,
                'price' => 100,
                'original_price' => 100,
                'discount_percentage' => 10,
                'image' => asset('images/placeholder.png'),
                'quantity' => 2,
            ],
        ]);

        // Act: Decrease quantity
        Livewire::test(Cart::class)
            ->call('updateQuantity', $product->id, 'decrease');

        // Assert: Quantity decreased
        $this->assertEquals(1, session('cart')[$product->id]['quantity']);
    }

    /** @test */
    public function it_can_remove_a_product_from_cart()
    {
        // Arrange: Add product to cart
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
        ]);

        session()->put('cart', [
            $product->id => [
                'name' => $product->name,
                'price' => 100,
                'original_price' => 100,
                'discount_percentage' => 10,
                'image' => asset('images/placeholder.png'),
                'quantity' => 1,
            ],
        ]);

        // Act: Remove product from cart
        Livewire::test(Cart::class)
            ->call('removeFromCart', $product->id);

        // Assert: Product is removed
        $this->assertEmpty(session('cart'));
    }

    /** @test */
    public function it_shows_empty_cart_message()
    {
        // Act & Assert
        Livewire::test(Cart::class)
            ->assertSee('Your cart is empty.');
    }
}
