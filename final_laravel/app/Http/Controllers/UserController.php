<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function profile()
    {
        return view('user');
    }

    public function order()
    {
        return view('accountorder');
    }
    public function account()
    {
        return view('accountedit');
    }
    public function wishlist()
    {
        return view('accountwishlist');
    }
}
