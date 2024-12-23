<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/category', \App\Http\Controllers\API\ProductCategoryController::class);
Route::apiResource('/product', \App\Http\Controllers\API\ProductController::class);
