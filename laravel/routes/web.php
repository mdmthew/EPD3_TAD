<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;

Route::get('/', function () {
    return view('welcome');
});

// Ver carrito
Route::get('/cart', [CartController::class, 'show'])
    ->middleware('auth');
// Añadir producto al carrito
Route::post('/cart/add', [CartItemController::class, 'add'])
    ->middleware('auth');
