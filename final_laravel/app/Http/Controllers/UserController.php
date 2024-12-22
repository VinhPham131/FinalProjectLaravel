<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return view('user', [
            'user' => $request->user(),
        ]);
    }

    public function order()
    {
        return view('accountorder');
    }
    public function account(Request $request)
    {
        return view('accountedit', [
            'user' => $request->user(),
        ]);
    }
    public function wishlist()
    {
        return view('accountwishlist');
    }
}
