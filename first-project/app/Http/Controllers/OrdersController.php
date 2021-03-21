<?php

namespace App\Http\Controllers;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders');
    }

    public function order_detail($id)
    {
        return view('order_detail');
    }
}
