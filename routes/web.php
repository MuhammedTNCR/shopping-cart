<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('products');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(\App\Http\Controllers\ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products');
});

Route::controller(\App\Http\Controllers\CartItemController::class)->group(function () {
    Route::post('/cart-items/{product?}', 'store')->name('cart_item_add')->middleware('auth');
    Route::put('/cart-item/{cartItem?}', 'update')->name('cart_item_update')->middleware('auth');
    Route::delete('/cart-item/{cartItem?}', 'destroy')->name('cart_item_delete')->middleware('auth');
});

Route::controller(\App\Http\Controllers\CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart')->middleware('auth');
});

Route::controller(\App\Http\Controllers\CouponController::class)->group(function () {
    Route::get('/get_coupon/{code?}', 'get_coupon')->name('get_coupon')->middleware('auth');
});

require __DIR__.'/auth.php';
