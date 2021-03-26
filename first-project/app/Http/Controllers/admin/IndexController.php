<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $best_seller = DB::select('
            SELECT p.product_name, sum(piece) piece
            FROM orders o
            INNER JOIN cart c on c.id = o.cart_id
            INNER JOIN cart_product cp on c.id = cp.cart_id
            INNER JOIN product p on p.id = cp.product_id
            GROUP BY p.product_name
            ORDER BY SUM(cp.piece) DESC
        ');

        $order_per_months = DB::select('
            SELECT DATE_FORMAT(o.created_at, "%Y-%m") month, sum(cp.piece) piece 
            FROM orders o
            INNER JOIN cart c on c.id = o.cart_id
            INNER JOIN cart_product cp on c.id = cp.cart_id
            GROUP BY DATE_FORMAT(o.created_at, "%Y-%m")
            ORDER BY DATE_FORMAT(o.created_at, "%Y-%m")
        ');

        return view('admin.index', compact('best_seller', 'order_per_months'));
    }
}
