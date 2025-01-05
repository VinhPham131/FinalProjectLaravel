<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SaleController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', EnsureUserIsAdmin::class])->group(function () {
    Route::post('/category', [ProductCategoryController::class, 'store']);
    Route::put('/category/{id}', [ProductCategoryController::class, 'update']);
    Route::delete('/category/{id}', [ProductCategoryController::class, 'destroy']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
    Route::post('/collection', [CollectionController::class, 'store']);
    Route::put('/collection/{id}', [CollectionController::class, 'update']);
    Route::delete('/collection/{id}', [CollectionController::class, 'destroy']);
    Route::post('/sale', [SaleController::class, 'store']);
    Route::put('/sale/{id}', [SaleController::class, 'update']);
    Route::delete('/sale/{id}', [SaleController::class, 'destroy']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::put('/contact/{id}', [ContactController::class, 'update']);
    Route::delete('/contact/{id}', [ContactController::class, 'destroy']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/contact/{id}', [ContactController::class, 'show']);
});

Route::apiResource('/category', ProductCategoryController::class)->only(['index', 'show']);
Route::apiResource('/product', ProductController::class)->only(['index', 'show']);
Route::apiResource('/collection', CollectionController::class)->only(['index', 'show']);
Route::apiResource('/sale', SaleController::class)->only(['index', 'show']);
Route::post('/login', [AuthController::class, 'login']);
