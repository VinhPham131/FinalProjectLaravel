<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Cart;
use App\Models\User;


class UserController extends Controller
{
    public function profile(Request $request)
    {
        return view('user', [
            'user' => $request->user(),
        ]);
        
    }

    public function order(Request $request)
    {
        $user = Auth::user();

        // Trả về view và truyền thông tin người dùng và giỏ hàng
        $cartComponent = new Cart();
        $cartComponent->loadCart(); // Tải giỏ hàng cho người dùng

        return view('accountorder', [
            'user' => $user,
            'cartItems' => $cartComponent->cart, // Truyền giỏ hàng vào view
            'total' => $cartComponent->total,
            'totalQuantity' => $cartComponent->totalQuantity,
        ]);

    }   
     public function account(Request $request)
    {
        return view('user', [
            'user' => $request->user(),
        ]);
    }

   
    public function updateAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    $user = Auth::user();
    if (!$user) {
        return back()->with('error', 'User not authenticated.');
    }

    $file = $request->file('avatar');

    // Lưu file vào thư mục storage/app/public/avatars
    $path = $file->store('avatars', 'public');

    if (!$path) {
        return back()->with('error', 'Failed to upload avatar.');
    }

    // Cập nhật đường dẫn vào database
    $user->avatar_url = 'storage/' . $path;

    try {
        $user->save();
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to save user: ' . $e->getMessage());
    }

    return back()->with('success', 'Avatar updated successfully.');
}

    
}
    
    

