<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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
// API xoá sản phẩm khỏi giỏ hàng (dùng cho AJAX)
Route::post('/api/gio-hang/xoa', [CartController::class, 'deleteCart'])->name('cart.delete.api');
// dang nhap
Route::get('/dang-nhap', [AuthController::class, 'index'])->name('page.login');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('auth.login');
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('auth.register');
Route::get('thong-tin-ca-nhan', [AuthController::class, 'profile'])->name('auth.profile');
Route::post('thong-tin-ca-nhan/cap-nhat', [AuthController::class, 'updateProfile'])->name('profile.update');
//tim kiem
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');


Route::post('/dat-hang', [CartController::class, 'pageCheckout'])->name('checkout.page');

Route::post('cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/order/add', [\App\Http\Controllers\OrderController::class, 'addOrder'])->name('order.add');

//order
Route::get('/don-hang', [OrderController::class, 'listOrder'])->name('order.view');
Route::get('/loc-gia', [ProductController::class, 'filterByPrice'])->name('product.filter.price');
Route::post('/don-hang/{id}/huy', [OrderController::class, 'cancerOrder'])->name('order.cancel');
