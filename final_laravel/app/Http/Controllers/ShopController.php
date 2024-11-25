<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with(['images', 'category', 'collection']) // Eager load relationships
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->get()
            ->map(function ($product) {
                // Attach the highest sale percentage and discounted price
                $product->highest_sale = $product->highestSale();
                $product->discounted_price = $product->salePrice();
                return $product;
            });

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('shop', compact('products'));
    }
}