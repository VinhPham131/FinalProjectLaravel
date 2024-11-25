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

        // Calculate sale-related attributes for the main product
        $product->highest_sale = $product->highestSale();
        $product->discounted_price = $product->salePrice();

        // Get all related products and calculate their sale prices
        $products = Product::with('images')->get()->map(function ($item) {
            $item->highest_sale = $item->highestSale();
            $item->discounted_price = $item->salePrice();
            return $item;
        });

        return view('detail', compact('product', 'products'));
    }
}