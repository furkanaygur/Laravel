<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $c = Category::where('slug', $slug)->firstOrFail();
        $products = $c->products()->get();

        return view('category', compact('c', 'products'));
    }

    public function product($slug, $product)
    {
        $c = Category::with('products.detail')->where('slug', $slug)->firstOrFail();
        $product = $c->products()->where('products.slug', $product)->first();
        return view('product', compact('c', 'product'));
    }
}
