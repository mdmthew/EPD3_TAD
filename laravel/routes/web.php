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