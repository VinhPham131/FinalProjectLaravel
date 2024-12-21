<?php

use App\Http\Controllers\verifyRegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

});

Route::get('/email/verify/{id}/{hash}', [verifyRegistrationController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');
