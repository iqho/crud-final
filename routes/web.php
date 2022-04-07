<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::view('/', 'home');

Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');

    Route::get('/create', 'create')->name('create');

    Route::get('/{product} ', 'show')->name('show');
    Route::patch('/{product} ', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');

    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::get('/{product}/change-status', 'changeStatus')->name('changeStatus');

});
