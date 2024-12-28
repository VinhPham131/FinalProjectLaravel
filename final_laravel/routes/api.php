<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/category', [ProductCategoryController::class, 'store']);
    Route::put('/category/{id}', [ProductCategoryController::class, 'update']);
    Route::delete('/category/{id}', [ProductCategoryController::class, 'destroy']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});

Route::apiResource('/category', ProductCategoryController::class)->only(['index', 'show']);
Route::apiResource('/product', ProductController::class)->only(['index', 'show']);
Route::post('/login', [AuthController::class, 'login']);
