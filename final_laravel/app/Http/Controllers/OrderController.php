<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
{
    // Fetch orders for the authenticated user with related items and products
    $orders = auth()->user()->orders()->with(['items.product'])->latest()->get();

    // Return the view with orders data
    return view('order', ['orders' => $orders]);
}
}
