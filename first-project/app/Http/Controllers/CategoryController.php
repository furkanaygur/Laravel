<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug_category)
    {
        $category = Category::where('slug', $slug_category)->firstOrFail();
        $subCategories = Category::where('parent_id', $category->id)->get();



        $order = request('order');
        if ($order == 'best_seller') {
            $products = $category->products()
                ->distinct()
                ->join('product_detail', 'product_detail.product_id', 'product.id')
                ->orderBy('product_detail.display_best_seller', 'DESC')->paginate(4);
        } else if ($order = 'new_products') {
            $products = $category->products()->distinct()->orderByDesc('updated_at')->paginate(4);
        } else {
            $products = $category->products()->distinct()->paginate(4);
        }
        return view('category', compact('category', 'subCategories', 'products'));
    }
}
