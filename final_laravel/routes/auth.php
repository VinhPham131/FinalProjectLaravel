<?php

use App\Http\Controllers\Auth\LogoutUserController;
use App\Http\Controllers\Auth\VerifyRegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        if (session('alert')) {
            return redirect()->route('home')->with('alert', session('alert'));
        }
        return redirect()->route('home');
    })->name('login');
});

Route::get('/email/verify/{id}/{hash}', [VerifyRegistrationController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/logout', [LogoutUserController::class, 'destroy'])
    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
    ->name('logout');
