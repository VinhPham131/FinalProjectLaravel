<?php

use App\Http\Controllers\API\ProductCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::prefix('v1')->group(function () {
//     Route::apiResource('categories', \App\Http\Controllers\API\ProductCategoryController::class);
// });
Route::get('/categories', [ProductCategoryController::class, 'index']);
Route::post('/categories', [ProductCategoryController::class, 'store']);

Route::get('/categories/{id}', [ProductCategoryController::class, 'show']);
Route::put('/categories/{id}', [ProductCategoryController::class, 'update']);
Route::delete('/categories/{id}', [ProductCategoryController::class, 'destroy']);
