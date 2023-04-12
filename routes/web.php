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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/product-add-update', [App\Http\Controllers\ProductController::class, 'productAddUpdate'])->name('product.add-update');
Route::get('/product-details/{id}', [App\Http\Controllers\ProductController::class, 'productDetails'])->name('product.details');
Route::delete('/product-delete/{id}', [App\Http\Controllers\ProductController::class, 'productDelete'])->name('product.delete');