<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index()
    {
        $users = User::with('detail')->orderByDesc('created_at')->paginate(8);
        $orders = Order::with('cart')->orderByDesc('created_at')->paginate(8);
        $products = Products::with(['detail', 'categories'])->orderByDesc('created_at')->paginate(8);
        return view('admin.index', compact('users', 'orders', 'products'));
    }
}
