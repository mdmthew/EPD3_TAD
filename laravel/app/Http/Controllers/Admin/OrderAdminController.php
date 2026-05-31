<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatusMail;
use Illuminate\Support\Facades\Mail;

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

        $order->load(['user', 'items.product']);

        Mail::to($order->user->email)
            ->send(new OrderStatusMail($order));

        return back()->with('success', 'Estado del pedido actualizado correctamente y correo enviado al usuario');
    }
}

