<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return view('user-tabs', [
            'user' => $request->user(),
        ]);
    }

    // UserController.php
    public function showAccountTab(Request $request, $tab)
    {
        $validTabs = ['cart', 'order', 'account'];
        $activeTab = in_array($tab, $validTabs) ? $tab : 'cart';

        $orders = $tab === 'order' ? $request->user()->orders()->latest()->get() : collect();

        return view('account', [
            'activeTab' => $activeTab,
            'user' => $request->user(),
            'orders' => $orders,
        ]);
    }
}
