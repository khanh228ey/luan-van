<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/san-pham/{id}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::Get('/danh-sach-san-pham', [ProductController::class, 'listProduct'])->name('product.list');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');