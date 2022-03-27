<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('products', ProductController::class);
