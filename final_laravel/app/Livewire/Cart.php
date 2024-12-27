<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartsItem;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $cart = [];
    public $total = 0;
    public $totalQuantity = 0;
    public $viewType;

    protected $listeners = ['cartUpdated' => 'loadCart', 'addToCart'];

    public function mount($viewType = 'mini')
    {
        $this->viewType = $viewType;
        $this->loadCart();
    }

    /**
     * Load cart items (session or database).
     */
    public function loadCart()
    {
        if (Auth::check()) {
            // Logged-in User: Fetch from database
            $cartItems = CartsItem::where('user_id', Auth::id())->with('product')->get();

            $this->cart = $cartItems->mapWithKeys(function ($item) {
                return [
                    $item->product_id => [
                        'name' => $item->product->name,
                        'price' => $item->product->salePrice(),
                        'image' => $item->product->images->first()->urls[0] ?? asset('images/placeholder.png'),
                        'quantity' => $item->quantity,
                        'discount_percentage' => $item->product->highestSale() ?? 0,
                        'original_price' => $item->product->price,
                        'material' => $item->product->material,
                        'size' => $item->product->size,

                    ]
                ];                      
            })->toArray();
        } else {
            // Guest User: Fetch from session
            $this->cart = session()->get('cart', []);
        }

        $this->calculateTotals();
    }

    /**
     * Add product to cart (session or database).
     */
    public function addToCart($id)
    {
        $id = intval($id);
        $product = Product::find($id);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        if (Auth::check()) {
            // Add to database
            $cartItem = CartsItem::firstOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $id],
                ['quantity' => 1]
            );

            if (!$cartItem->wasRecentlyCreated) {
                $cartItem->increment('quantity');
            }
        } else {
            // Add to session
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->salePrice(),
                    'original_price' => $product->price,
                    'discount_percentage' => $product->highestSale() ?? 0,
                    'image' => $product->images->first()->urls[0] ?? asset('images/placeholder.png'),
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        $this->loadCart();
        $this->dispatch('cart-updated', message: "{$product->name} added to cart.");
    }
    public function updateQuantity($id, $action)
    {
        if (Auth::check()) {
            // Update quantity for logged-in user
            $cartItem = CartsItem::where('user_id', Auth::id())->where('product_id', $id)->first();

            if ($cartItem) {
                if ($action === 'increase') {
                    $cartItem->increment('quantity');
                } elseif ($action === 'decrease') {
                    if ($cartItem->quantity > 1) {
                        $cartItem->decrement('quantity');
                    } else {
                        $cartItem->delete();
                    }
                }
            }
        } else {
            // Update quantity for guest user
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
        }

        $this->loadCart();
    }

    public function removeFromCart($id)
    {
        if (Auth::check()) {
            // Remove item for logged-in user
            CartsItem::where('user_id', Auth::id())->where('product_id', $id)->delete();
        } else {
            // Remove item for guest user
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        $this->loadCart();
    }

    /**
     * Calculate totals.
     */
    public function calculateTotals()
    {
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $this->totalQuantity = collect($this->cart)->sum('quantity');
    }

    public function render()
    {
        return view($this->viewType === 'mini' ? 'livewire.cart' : 'livewire.shopping-cart', [
            'cartItem' => $this->cart,
            'total' => $this->total,
            'totalQuantity' => $this->totalQuantity,
        ]);
    }
}
