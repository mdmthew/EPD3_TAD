<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();

        $cart = Cart::with('items.product')
            ->where('user_id', $user->id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'El carrito está vacío');
        }

        DB::beginTransaction();

        try {
            $total = $cart->items->sum(function ($item) {
                return $item->quantity * $item->unit_price;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $user->addresses()->first()->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'subtotal' => $item->quantity * $item->unit_price,
                ]);
            }

            $cart->items()->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Compra realizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error al procesar la compra');
        }
    }
}
