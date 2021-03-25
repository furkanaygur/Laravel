<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->filled('search_key')) {
            request()->flash();
            $search_key = request('search_key');
            $products = Product::with('categories')->where('product_name', 'LIKE', '%' . $search_key . '%')
                ->where('product_description', 'LIKE', '%' . $search_key . '%')
                ->orderByDesc('created_at')->paginate(8)->appends('search_key', $search_key);
        } else {
            request()->flush();
            $products = Product::with('categories')->orderByDesc('created_at')->paginate(8);
        }
        return view('admin.product.index', compact('products'));
    }

    public function form($id = 0)
    {
        $product = new Product;
        if ($id > 0) {
            $product = Product::find($id);
        }

        $all_categories = Product::all();

        return view('admin.product.form', compact('product', 'all_categories'));
    }

    public function save($id = 0)
    {
        $data = request()->only('slug', 'product_name', 'price', 'product_description');

        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('product_name'));
            request()->merge(['slug' => $data['slug']]);
        }

        $this->validate(request(), [
            'product_name' => 'required',
            'price' => "required|regex:/^\d+(\.\d{1,3})?$/",
            'slug' => request('original_slug') != request('slug') ? 'unique:product,slug' : ''
        ]);

        if ($id > 0) {
            $product = Product::where('id', $id)->firstOrFail();
            $product->update($data);
        } else {
            $product = Product::create($data);
        }

        $message = $id > 0 ? 'Product Updated' : 'Product Added';
        return redirect()->route('admin.product-update', $product->id)
            ->with('message', $message)
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        // $product->detail->detach();
        $product->delete();

        return redirect()->route('admin.products')
            ->with('message', 'Row Deleted')
            ->with('message_type', 'success');
    }
}
