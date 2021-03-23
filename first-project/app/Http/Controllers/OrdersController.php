<?php

namespace App\Http\Controllers;

use App\Models\Orders;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::with('cart')
            ->whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderByDesc('created_at')->get();

        return view('orders', compact('orders'));
    }

    public function order_detail($id)
    {
        $order = Orders::with('cart.cart_product.product')
            ->whereHas('cart', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->where('orders.id', $id)->firstOrFail();

        return view('order_detail', compact('order'));
    }
}
