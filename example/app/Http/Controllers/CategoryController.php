<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $c = Category::where('slug', $slug)->firstOrFail();
        $products = $c->products()->get();
        return view('category', compact('c', 'products'));
    }
}
