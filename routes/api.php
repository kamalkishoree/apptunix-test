<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',[LoginController::class,'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::post('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::get('/products',[ProductController::class,'index'])->name('products');
    Route::get('/product/{id}',[ProductController::class,'view'])->name('product.view');
    Route::post('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');


});
