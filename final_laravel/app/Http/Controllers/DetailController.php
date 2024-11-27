<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Calculate sale-related attributes for the main product
        $this->calculateSaleAttributes($product);

        // Get all related products and calculate their sale prices
        $products = Product::with('images')->get()->each(function ($item) {
            $this->calculateSaleAttributes($item);
        });

        return view('detail', compact('product', 'products'));
    }

    private function calculateSaleAttributes($product)
    {
        $product->highest_sale = $product->highestSale();
        $product->discounted_price = $product->salePrice();
    }
}
