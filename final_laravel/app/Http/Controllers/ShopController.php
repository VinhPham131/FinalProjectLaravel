<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort'); // Retrieve the sort parameter

        $products = Product::with(['images', 'category', 'collection'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->when($sort, function ($query, $sort) {
                switch ($sort) {
                    case 'lowest_to_highest':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'highest_to_lowest':
                        $query->orderBy('price', 'desc');
                        break;
                    // case 'best_seller':
                    //     $query->orderBy('sales_count', 'desc'); // Replace with the actual field name
                    //     break;
                }
            })
            ->get()
            ->map(function ($product) {
                $product->highest_sale = $product->highestSale();
                $product->discounted_price = $product->salePrice();
                return $product;
            });

        $categories = ProductCategory::all();

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('shop', compact('products', 'categories'));
    }


}