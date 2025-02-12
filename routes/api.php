<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Product\ProductController;
use App\Http\Controllers\API\Order\OrderController;

includeRouteFiles(__DIR__.'/docs/');

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [AuthController::class, 'getMe'])->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);
Route::get('products/all', [ProductController::class, 'all']); 

Route::apiResource('orders', OrderController::class);
Route::apiResource('categories', CategoryController::class);

