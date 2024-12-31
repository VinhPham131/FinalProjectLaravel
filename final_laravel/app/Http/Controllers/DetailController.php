<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DetailController extends Controller
{
    public function show(Product $product)
    {
        return view('detail', compact(var_name: 'product'));
    }
}
