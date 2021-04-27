<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cart')->orderByDesc('created_at')->get();
        return view('admin.order.orders', compact('orders'));
    }

    public function update($id)
    {
        if (request()->isMethod('POST')) {

            $this->validate(request(), [
                'name' => 'required',
                'surname' => 'required',
                'price' => 'required',
                'bank' => 'required',
                'phone' => 'required',
                'email' => 'required | email',
                'address' => 'required',
            ]);

            $order = [
                'name' => request('name'),
                'surname' => request('surname'),
                'price' => request('price'),
                'bank' => request('bank'),
                'phone' => request('phone'),
                'email' => request('email'),
                'address' => request('address'),
                'statu' => request('statu'),
            ];

            Order::where('id', $id)->update($order);

            return back()->with('message', 'Succesfully Updated')
                ->with('message_type', 'success');
        }

        $order = Order::with(['cart.cart_products.product.categories', 'cart.cart_products.product.detail'])->where('id', $id)->firstOrFail();
        return view('admin.order.order-detail', compact('order'));
    }
}
