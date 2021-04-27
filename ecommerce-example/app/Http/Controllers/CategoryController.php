<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $products = DB::select('SELECT products.id, products.title, products.price, 
        products.slug as productSlug, category.slug as categorySlug, category.name as categoryName, product_detail.statu, product_detail.old_price FROM products 
        INNER JOIN category_product ON category_product.product_id = products.id 
        INNER JOIN product_detail ON product_detail.product_id = products.id 
        INNER JOIN category ON category.id = category_product.category_id
        WHERE category.slug = ? AND products.deleted_at IS NULL ', [$slug]);

        return view('category')
            ->with('products', $products);
    }

    public function product($slug, $product)
    {
        $product = DB::select('SELECT products.id, products.title, products.price, 
        products.slug as productSlug, category.slug as categorySlug, category.name as categoryName, product_detail.statu, 
        product_detail.old_price, product_detail.image, products.description FROM products 
        INNER JOIN category_product ON category_product.product_id = products.id 
        INNER JOIN product_detail ON product_detail.product_id = products.id 
        INNER JOIN category ON category.id = category_product.category_id
        WHERE products.slug = ? AND products.deleted_at IS NULL', [$product]);

        return view('product')->with('product', $product[0]);
    }
}
