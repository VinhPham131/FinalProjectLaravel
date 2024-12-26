<?php
// filepath: /c:/Users/This PC/Desktop/FinalProjectLaravel/final_laravel/app/Http/Livewire/ShoppingCart.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShoppingCart extends Component
{
    public $cart = [];
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotal();
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

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        $this->loadCart();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function render()
    {
        $cartItems = collect($this->cart)->map(function ($item, $id) {
            $product = Product::find($id);
            return (object) [
                'product' => $product,
                'quantity' => $item['quantity'],
            ];
        });

        return view('livewire.shopping-cart', ['cartItems' => $cartItems, 'total' => $this->total]);
    }
}