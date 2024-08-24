<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\DashboardUserController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/detileProduct/{id}',[HomeController::class, 'detileProduct'])->name('product.detail');
Route::post('/addtocart/{id}',[HomeController::class, 'addtocart'])->name('addToCart');
Route::get('/checkout',[HomeController::class, 'checkout'])->name('checkout');
Route::delete('/deleteCart/{id}',[HomeController::class, 'deleteCart'])->name('deleteCart');
Route::get('/confirm-checkout', [HomeController::class, 'confirmCheckout'])->name('confirm.checkout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard')->middleware('check-role:admin');
    Route::get('/product', [ProductController::class, 'index'])->name('product')->middleware('check-role:admin');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store')->middleware('check-role:admin');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update')->middleware('check-role:admin');
    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show')->middleware('check-role:admin');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('check-role:admin');

    Route::get('/category',[ProductCategoryController::class, 'index'])->name('category')->middleware('check-role:admin');
    Route::post('/category',[ProductCategoryController::class, 'store'])->name('category.store')->middleware('check-role:admin');
    Route::post('/category/{id}',[ProductCategoryController::class, 'update'])->name('category.update')->middleware('check-role:admin');
    Route::get('/category/{id}',[ProductCategoryController::class, 'show'])->name('category.show')->middleware('check-role:admin');
    Route::delete('/category/{id}',[ProductCategoryController::class, 'destroy'])->name('category.destroy')->middleware('check-role:admin');
    
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard')->middleware('check-role:user');
});

require __DIR__.'/auth.php';
