<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class DetailController extends Controller
{
    public function index($id)
    {
        $product = Product::with('images')->find($id);

        // Handle case where product doesn't exist
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Get all products for the "Related Products" section
        $products = Product::with('images')->get();

        return view('detail', compact('product', 'products'));
    }
}