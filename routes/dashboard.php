<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\OrderController;

Route::middleware(['auth', 'role:admin,editor'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('users', UserController::class)->middleware('role:admin');

    Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::post('/{id}/restore', 'restore')->name('restore');
        Route::delete('/{id}/force-delete', 'forceDelete')->name('forceDelete');
    });
    Route::resource('products', ProductController::class);

    Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
        Route::get('/trash', 'trash')->name('trash');
        Route::post('/{id}/restore', 'restore')->name('restore');
        Route::delete('/{id}/force-delete', 'forceDelete')->name('forceDelete');
    });
    Route::resource('categories', CategoryController::class);

    Route::resource('orders', OrderController::class)->only(['index', 'show']);
});
