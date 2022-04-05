<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix'=>'products','as'=>'products.'], function(){

    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/', [ProductController::class, 'store'])->name('store');

    Route::get('/create', [ProductController::class, 'create'])->name('create');

    Route::get('/{product} ', [ProductController::class, 'show'])->name('show');
    Route::patch('/{product} ', [ProductController::class, 'update'])->name('update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');

    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::get('/{product}/change-status', [ProductController::class, 'changeStatus'])->name('changeStatus');

});