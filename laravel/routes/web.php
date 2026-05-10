<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ProductAdminController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/guias', [ProductController::class, 'index'])
    ->name('guides.index');

Route::get('/guias/{product}', [ProductController::class, 'show'])
    ->name('guides.show');

Route::get('/nosotros', function () {
    return view('about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Rutas protegidas usuario logueado
|--------------------------------------------------------------------------
*/

Route::get('/pedidos', function () {
    $orders = Order::with('items.product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('orders.index', compact('orders'));
})->middleware('auth')->name('orders.index');

Route::get('/favoritos', function () {
    $favorites = Product::whereIn('id', function ($query) {
        $query->select('product_id')
            ->from('favorites')
            ->where('user_id', Auth::id());
    })->get();

    return view('favorites.index', compact('favorites'));
})->middleware('auth')->name('favorites.index');

Route::post('/favoritos/{product}', function (Product $product) {
    DB::table('favorites')->updateOrInsert([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
    ]);

    return back()->with('success', 'Producto añadido a favoritos');
})->middleware('auth')->name('favorites.add');

Route::delete('/favoritos/{product}', function (Product $product) {
    DB::table('favorites')
        ->where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->delete();

    return redirect('/favoritos');
})->middleware('auth')->name('favorites.remove');

/*
|--------------------------------------------------------------------------
| Rutas funcionales de carrito / compra
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'show'])
    ->middleware('auth')
    ->name('cart.index');

Route::post('/cart/add', [CartItemController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

Route::post('/cart/item/{cartItem}/increase', [CartItemController::class, 'increase'])
    ->middleware('auth')
    ->name('cart.item.increase');

Route::post('/cart/item/{cartItem}/decrease', [CartItemController::class, 'decrease'])
    ->middleware('auth')
    ->name('cart.item.decrease');

Route::delete('/cart/item/{cartItem}', [CartItemController::class, 'destroy'])
    ->middleware('auth')
    ->name('cart.item.destroy');

Route::post('/checkout', [OrderController::class, 'checkout'])
    ->middleware('auth')
    ->name('checkout');

/*
|--------------------------------------------------------------------------
| Rutas administrador
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/productos', [ProductAdminController::class, 'index'])
            ->name('products.index');

        Route::get('/productos/create', [ProductAdminController::class, 'create'])
            ->name('products.create');

        Route::post('/productos', [ProductAdminController::class, 'store'])
            ->name('products.store');

        Route::get('/productos/{product}/edit', [ProductAdminController::class, 'edit'])
            ->name('products.edit');

        Route::put('/productos/{product}', [ProductAdminController::class, 'update'])
            ->name('products.update');

        Route::patch('/productos/{product}/toggle', [ProductAdminController::class, 'toggle'])
            ->name('products.toggle');

        Route::delete('/productos/{product}', [ProductAdminController::class, 'destroy'])
            ->name('products.destroy');
});