<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

            $this->validate(request(), [
                'title' => 'required',
                'price' => 'required',
                'category' => 'required',
                'statu' => 'required'
            ]);

            $product = [
                'title' => request('title'),
                'price' => request('price')
            ];

            if (request('slug') != "") {
                $product['slug'] = Str::slug(request('slug'));
            } else {
                $product['slug'] = Str::slug(request('title'));
            }
            if (request()->has('description')) {
                $product['description'] = request('description');
            }

            $product_detail = [
                'in_index' => request()->has('in_index') ? 1 : 0,
                'statu' => request('statu')
            ];
            if (request()->has('old_price')) {
                $product_detail['old_price'] = request('old_price');
            }

            Products::where('id', $id)->update($product);
            ProductDetail::where('product_id', $id)->update($product_detail);
            DB::table('category_product')->where('product_id', $id)->update([
                'category_id' => request('category')
            ]);

            return back()->with('message', 'Succesfully Updated')
                ->with('message_type', 'success');
        }

        $product = Products::with(['detail', 'categories'])->where('id', $id)->firstOrFail();
        $categories = Category::all();
        return view('admin.product.product-detail', compact('product', 'categories'));
    }

    public function add_product()
    {
        if (request()->isMethod('POST')) {

            $this->validate(request(), [
                'title' => 'required',
                'price' => 'required',
                'category' => 'required',
                'statu' => 'required'
            ]);

            $product = [
                'title' => request('title'),
                'price' => request('price')
            ];

            if (request('slug') != "") {
                $product['slug'] = Str::slug(request('slug'));
            } else {
                $product['slug'] = Str::slug(request('title'));
            }
            if (request()->has('description')) {
                $product['description'] = request('description');
            }

            $product_detail = [
                'in_index' => request()->has('in_index') ? "1" : "0",
                'statu' => request('statu')
            ];
            if (request()->has('old_price')) {
                $product_detail['old_price'] = request('old_price');
            }

            $id = Products::insertGetId($product);
            $product_detail['product_id'] = $id;
            ProductDetail::insert($product_detail);
            DB::table('category_product')->insert([
                'product_id' => $id,
                'category_id' => request('category')
            ]);

            return back()->with('message', 'Succesfully Added')
                ->with('message_type', 'success');
        }


        $categories = Category::all();
        return view('admin.product.add-product', compact('categories'));
    }
}
