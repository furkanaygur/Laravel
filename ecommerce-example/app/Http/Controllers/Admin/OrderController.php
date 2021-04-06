<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cart')->orderByDesc('created_at')->get();
        return view('admin.order.orders', compact('orders'));
    }

    public function update($id)
    {
        return $id;
    }
}
