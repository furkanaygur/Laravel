<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index($slug_product)
    {
        $product = Product::whereSlug($slug_product)->firstOrFail();
        $categories = $product->categories()->distinct()->get();
        return view('product', compact('product', 'categories'));
    }

    public function search_product()
    {
        $search_key = request()->input('search_key');
        $products = Product::where('product_name', 'like', '%' . $search_key . '%')
            ->orWhere('product_description', 'like', '%' . $search_key . '%')
            ->paginate(8);
        request()->flash();
        return view('search', compact('products'));
    }
}
