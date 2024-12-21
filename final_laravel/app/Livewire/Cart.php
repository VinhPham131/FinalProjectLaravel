<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['addToCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function addToCart($id)
    {
        //Check if id exists
        $id = intval($id);

        $product = Product::find($id);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->discounted_price ?? $product->price,
                'image' => $product->images->first()->urls[0] ?? asset('images/placeholder.png'),
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->loadCart();
        session()->flash('success', 'Product added to cart.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $this->loadCart();
        session()->flash('success', 'Product removed from cart.');
    }

    public function updateQuantity($id, $action)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['quantity'] += 1;
            } elseif ($action === 'decrease') {
                $cart[$id]['quantity'] -= 1;
                if ($cart[$id]['quantity'] < 1) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);
        $this->loadCart();
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function render()
    {
        return view('livewire.cart', ['total' => $this->getTotal()]);
    }
}