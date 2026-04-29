<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;

// Home → listado de productos
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Detalle de producto
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Carrito
Route::get('/cart', [CartController::class, 'show'])
    ->middleware('auth')
    ->name('cart.show');

// Añadir producto al carrito
Route::post('/cart/add', [CartItemController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

// Checkout
Route::post('/checkout', [OrderController::class, 'checkout'])
    ->middleware('auth')
    ->name('checkout');

Route::get('/', function () {
    return view('home');
});

Route::get('/guias', function () {
    return view('products.index');
});

Route::get('/guias/{slug}', function ($slug) {
    return view('products.show');
});

Route::get('/nosotros', function () {
    return view('about');
});

Route::get('/carrito', function () {
    return view('cart.index');
});

Route::get('/pedidos', function () {
    return view('orders.index');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/productos', function () {
    return view('admin.products.index');
});