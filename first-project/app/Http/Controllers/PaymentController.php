<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\UserDetail;
use Cart;

class PaymentController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('users.Login_form')
                ->with('message', 'Please Login')->with('message_type', 'info');
        } else if (count(Cart::content()) == 0) {
            return redirect()->route('index')
                ->with('message', 'You dont have a product')->with('message_type', 'info');
        }

        $user_detail = auth()->user()->detail;

        // dd($user_detail);

        return view('payment', compact('user_detail'));
    }


    public function pay()
    {
        $order = request()->all();
        $order['cart_id'] = session('cart_id');
        $order['bank'] = 'ABank';
        $order['installment'] = 1;
        $order['statu'] = 'Your order has been taken';
        $order['price'] = Cart::subtotal();

        Orders::create($order);
        Cart::destroy();
        session()->forget('cart_id');

        return redirect()->route('orders')
            ->with('message', 'Payment Successful')->with('message_type', 'success');
    }
}
