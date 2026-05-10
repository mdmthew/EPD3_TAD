<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update([
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Estado del pedido actualizado correctamente');
    }
}