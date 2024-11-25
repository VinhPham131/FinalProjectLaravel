<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with('images')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->get();

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('shop', compact('products'));
    }


    
}