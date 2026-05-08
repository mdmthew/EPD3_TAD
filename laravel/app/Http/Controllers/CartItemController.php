<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->quantity ?? 1;

        $product = Product::findOrFail($request->product_id);

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito');
    }

    public function increase(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->quantity++;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada');
    }

    public function decrease(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        if ($cartItem->quantity <= 1) {
            $cartItem->delete();

            return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
        }

        $cartItem->quantity--;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada');
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }
    }
}