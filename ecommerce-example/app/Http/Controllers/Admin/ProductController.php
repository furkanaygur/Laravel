<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::with(['detail', 'categories'])->orderByDesc('created_at')->get();
        return view('admin.product.products', compact('products'));
    }

    public function update($id)
    {
        if (request()->isMethod('POST')) {
            return back()->with('message', 'Succesfully Updated')
                ->with('message_type', 'success');
        }

        $product = Products::with(['detail', 'categories'])->where('id', $id)->firstOrFail();
        $categories = Category::all();
        return view('admin.product.product-detail', compact('product', 'categories'));
    }
}
