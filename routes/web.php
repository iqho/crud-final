<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('products/change-status', [ProductController::class, 'changeStatus'])->name('product.changeStatus');

Route::resource('products', ProductController::class);
