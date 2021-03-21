<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::whereRaw('parent_id is null')->take(8)->get();

        $product_slider = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.display_slider', 1)
            ->orderBy('product.updated_at', 'DESC')->take(5)->get();

        $product_opportunity = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.display_opportunity', 1)
            ->orderBy('updated_at', 'DESC')->first();

        $product_best_seller = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.display_best_seller', 1)
            ->orderBy('product.updated_at', 'DESC')->take(4)->get();

        $product_discount = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.display_discount', 1)
            ->orderBy('product.updated_at', 'DESC')->take(4)->get();

        return view('index', compact('categories', 'product_slider', 'product_opportunity', 'product_best_seller', 'product_discount'));
    }
}
