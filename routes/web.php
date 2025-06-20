<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/san-pham/{id}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::Get('/danh-sach-san-pham', [ProductController::class, 'listProduct'])->name('product.list');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');

Route::get('thuong-hieu/{brandId}', [ProductController::class, 'listProductByBrand'])->name('product.brand');
Route::get('danh-muc/{categoryId}', [ProductController::class, 'listProductByCategory'])->name('product.category');
//gio hang
Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/gio-hang/them', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/gio-hang/xoa', [CartController::class, 'deleteCart'])->name('cart.delete');
// dang nhap
Route::get('/dang-nhap', [AuthController::class, 'index'])->name('page.login');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('auth.login');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('auth.register');

Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');