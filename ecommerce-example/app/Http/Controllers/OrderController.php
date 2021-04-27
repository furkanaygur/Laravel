<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Models\UserDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('cart')->whereHas('cart', function ($q) {
            $q->where('user_id', auth()->id());
        })->orderByDesc('id')->get();

        return view('orders')->with('orders', $orders);
    }

    public function complate()
    {
        if (!auth()->check()) {
            return redirect()->route('user.login.form')->with('message', 'You have to login!')
                ->with('message_type', 'info');
        } else if (count(Cart::content()) == 0) {
            return redirect()->route('user.index')
                ->with('message', 'You must have items in your cart to process payment.')
                ->with('message_type', 'info');
        }

        $infos = User::with('detail')->where('id', auth()->id())->firstOrFail();
        return view('order-complate', compact('infos'));
    }

    public function payment()
    {
        $this->validate(request(), [
            'name' => 'required | min:3 | max:60',
            'surname' => 'required | min:3 | max:60',
            'email' => 'required | email',
            'bank' => 'required',
            'card_number' => 'required',
            'cvv' => 'required',
            'year' => 'required',
            'month' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $infos = request()->only(['name', 'surname', 'email', 'bank', 'phone', 'address']);

        User::where('id', auth()->id())->update([
            'name' => $infos['name'],
            'surname' => $infos['surname']
        ]);

        UserDetail::where('user_id', auth()->id())->update([
            'address' => $infos['address'],
            'phone' => $infos['phone'],
            'bank' => $infos['bank']
        ]);

        $infos['price'] = Cart::subtotal();
        $infos['cart_id'] = session('cart_id');
        $infos['statu'] = 'Your order is preparing';

        Order::create($infos);
        Cart::destroy();
        session()->forget('cart_id');

        return redirect()->route('order');
    }

    public function detail($id)
    {
        $order = Order::with(['cart.cart_products.product.categories', 'cart.cart_products.product.detail'])->where('order.id', $id)
            ->whereHas('cart', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->firstOrFail();
        return view('order-detail', compact('order'));
    }
}
