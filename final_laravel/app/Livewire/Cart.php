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
            $discountedPrice = $product->salePrice();
            $discountPercentage = $product->highestSale();

            $cart[$id] = [
                'name' => $product->name,
                'price' => $discountedPrice,
                'original_price' => $product->price,
                'discount_percentage' => $discountPercentage,
                'image' => $product->images->first()->urls[0] ?? asset('images/placeholder.png'),
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->loadCart();

        // Gửi sự kiện với tham số trực tiếp
        $this->dispatch('cart-updated', message: "{$product->name} added to cart.");
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        $this->loadCart();
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
    public function getTotalQuantity()
    {
        $totalQuantity = 0;
        foreach ($this->cart as $item) {
            $totalQuantity += $item['quantity'];
        }
        return $totalQuantity;
    }
    public function render()
    {
        return view('livewire.cart', [
            'total' => $this->getTotal(),

            'totalQuantity' => $this->getTotalQuantity(),
        ]);
    }
}