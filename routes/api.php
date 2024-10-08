<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::apiResource('product', ProductController::class)->middleware('auth:sanctum');
Route::apiResource('category', ProductCategoryController::class)->middleware('auth:sanctum');
Route::get('cart', [CartController::class, 'index'])->middleware('auth:sanctum');
Route::post('addtocart/{id}', [CartController::class, 'store'])->middleware('auth:sanctum');
Route::delete('deletecart/{id}', [CartController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('checkout', [CartController::class, 'checkout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
