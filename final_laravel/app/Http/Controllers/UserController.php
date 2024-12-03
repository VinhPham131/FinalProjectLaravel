<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function whishlist()
    {
        return view('accountwhishlist');
    }
}

