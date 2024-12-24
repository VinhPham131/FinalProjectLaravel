<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = collect($cart)->map(function ($item, $id) {
            $product = Product::find($id);
            return (object) [
                'product' => $product,
                'quantity' => $item['quantity'], 
                
            ];
        });

        $total = $cartItems->sum(function ($item) {
            return $item->product->salePrice() * $item->quantity;
        });

        return view('shoppingcart', compact('cartItems', 'total'));
    }
}