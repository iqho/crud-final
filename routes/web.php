<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::patch('products/change-status', [ProductController::class, 'ChangeStatus'])->name('product.changeStatus');

Route::resource('products', ProductController::class);
