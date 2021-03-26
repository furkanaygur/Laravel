<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;

class OrderController extends Controller
{
    public function index()
    {
        if (request()->filled('search_key')) {
            request()->flash();
            $search_key = request('search_key');
            $orders = Orders::with('cart.user')->where('full_name', 'LIKE', '%' . $search_key . '%')
                ->where('address', 'LIKE', '%' . $search_key . '%')
                ->orderByDesc('created_at')->paginate(8)->appends('search_key', $search_key);
        } else {
            request()->flush();
            $orders = Orders::with('cart.user')->orderByDesc('created_at')->paginate(8);
        }
        return view('admin.order.index', compact('orders'));
    }

    public function form($id = 0)
    {
        if ($id > 0) {
            $order = Orders::with('cart.cart_product.product')->find($id);
        }

        return view('admin.order.form', compact('order'));
    }

    public function save($id = 0)
    {


        $this->validate(request(), [
            'full_name' => 'required',
            'price' => "required|regex:/^\d+(\.\d{1,4})?$/",
            'address' => 'required',
            'phone' => 'required',
            'bank' => 'required',
            'installment' => 'required',
            'statu' => 'required'
        ]);

        $data = request()->only('full_name', 'address', 'address2', 'product_description', 'statu', 'installment', 'bank');


        if ($id > 0) {
            $order = Orders::where('id', $id)->firstOrFail();
            $order->update($data);
        }

        return redirect()->route('admin.order-update', $order->id)
            ->with('message', 'Order Updated')
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        Orders::destroy($id);

        return redirect()->route('admin.orders')
            ->with('message', 'Row Deleted')
            ->with('message_type', 'success');
    }
}
