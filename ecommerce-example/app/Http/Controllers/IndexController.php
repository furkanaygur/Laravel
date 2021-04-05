<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Products::with(['categories', 'detail'])->whereHas('detail', function ($query) {
            return $query->where('in_index', '=', 1)->where('statu', '!=', 3);
        })->paginate(16);

        return view('index', compact('products'));
    }
}
