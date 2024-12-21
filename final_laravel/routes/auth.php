<?php

use App\Http\Controllers\VerifyRegistrationController;
use App\Http\Controllers\Auth\LogoutUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

});

Route::get('/email/verify/{id}/{hash}', [VerifyRegistrationController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

Route::post('/logout', [LogoutUserController::class, 'destroy'])
    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
    ->name('logout');
