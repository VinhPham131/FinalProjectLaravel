<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product}', [DetailController::class, 'show'])->name('detail');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/order', [UserController::class, 'order'])->name('user.order');
Route::get('/user/account', [UserController::class, 'account'])->name('user.account');
Route::get('/user/wishlist', [UserController::class, 'wishlist'])->name('user.wishlist');

require __DIR__ . '/auth.php';
