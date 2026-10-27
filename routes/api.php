<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('v1', function () {
    return response()->json([
        'message' => 'Product API v1',
    ]);
})->name('api.v1.index');

Route::get('v1/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('v1/products/queries', [ProductsController::class, 'queries'])->name('products.queries');
Route::get('v1/products/{product}', [ProductsController::class, 'show'])->name('products.show');

Route::get('v1/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('v1/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
