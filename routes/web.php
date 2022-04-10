<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Categories\CategoryController;

Route::view('/', 'home')->name('home');

Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{product}', 'show')->name('show');
    Route::patch('/{product}', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');

    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::get('/{product}/change-status', 'changeStatus')->name('changeStatus');

});

Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{category}', 'show')->name('show');
    Route::patch('/{category}', 'update')->name('update');
    Route::delete('/{category}', 'destroy')->name('destroy');

    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::get('/{category}/change-status', 'changeStatus')->name('changeStatus');

});
