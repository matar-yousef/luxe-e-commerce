<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/about', 'front_assets.partials.about')->name('about');

Route::controller(ShopController::class)->name('shop.')->group(function () {
    Route::get('/shop', 'index')->name('index');
    Route::get('/shop/new-arrivals', 'newArrivals')->name('new');
    Route::get('/product/{id}', 'show')->name('show');
});

Route::middleware('auth')->group(function () {

    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{id}', 'add')->name('add');
        Route::delete('/remove/{id}', 'remove')->name('remove');
    });

    Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', function () {
            return view('front_assets.checkout');
        })->name('index');

        Route::post('/', 'store')->name('store');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';
