<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\OrderAdminController;


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

/*
|--------------------------------------------------------------------------
| Rutas funcionales de favoritos
|--------------------------------------------------------------------------
*/

Route::get('/favoritos', function () {
    $favorites = Auth::user()
        ->favoriteProducts()
        ->where('is_active', true)
        ->get();

    return view('favorites.index', compact('favorites'));
})->middleware('auth')->name('favorites.index');

Route::post('/favoritos/{product}', function (Product $product) {
    Auth::user()
        ->favoriteProducts()
        ->syncWithoutDetaching([$product->id]);

    return back()->with('success', 'Guía añadida a favoritos');
})->middleware('auth')->name('favorites.add');

Route::delete('/favoritos/{product}', function (Product $product) {
    Auth::user()
        ->favoriteProducts()
        ->detach($product->id);

    return back()->with('success', 'Guía eliminada de favoritos');
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


        /*
        |---------------------------
        | Productos
        |---------------------------
        */

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


        /*
        |---------------------------
        | Categorias
        |---------------------------
        */

        Route::get('/categorias', [CategoryAdminController::class, 'index'])
            ->name('categories.index');

        Route::get('/categorias/create', [CategoryAdminController::class, 'create'])
            ->name('categories.create');

        Route::post('/categorias', [CategoryAdminController::class, 'store'])
            ->name('categories.store');

        Route::get('/categorias/{category}/edit', [CategoryAdminController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categorias/{category}', [CategoryAdminController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categorias/{category}', [CategoryAdminController::class, 'destroy'])
            ->name('categories.destroy');


        /*
        |---------------------------
        | Usuarios
        |---------------------------
        */

        Route::get('/usuarios', [UserAdminController::class, 'index'])
            ->name('users.index');

        Route::get('/usuarios/{user}/edit', [UserAdminController::class, 'edit'])
            ->name('users.edit');

        Route::put('/usuarios/{user}', [UserAdminController::class, 'update'])
            ->name('users.update');

        Route::delete('/usuarios/{user}', [UserAdminController::class, 'destroy'])
            ->name('users.destroy');


        /*
        |---------------------------
        | Pedidos
        |---------------------------
        */

        Route::get('/pedidos', [OrderAdminController::class, 'index'])
            ->name('orders.index');

        Route::patch('/pedidos/{order}/estado', [OrderAdminController::class, 'updateStatus'])
            ->name('orders.updateStatus');


        /*
        |---------------------------
        | Estadísticas de favoritos
        |---------------------------
        */

        Route::get('/favoritos', function () {
            $products = Product::withCount('favoritedByUsers as favorites_count')
                ->orderByDesc('favorites_count')
                ->get();

            return view('admin.favorites.index', compact('products'));
        })->name('favorites.index');

    });

