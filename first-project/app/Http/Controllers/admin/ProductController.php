<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;

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
        $product_categories = [];
        if ($id > 0) {
            $product = Product::find($id);
            $product_categories = $product->categories()->pluck('category_id')->all();
        }

        $all_categories = Category::all();

        return view('admin.product.form', compact('product', 'all_categories', 'product_categories'));
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

        $data_detail = request()->only('display_slider', 'display_opportunity', 'display_best_seller', 'display_discount');

        $categories = request('categories');


        if ($id > 0) {
            $product = Product::where('id', $id)->firstOrFail();
            $product->update($data);
            $product->detail()->update($data_detail);
            $product->categories()->sync($categories);
        } else {
            $product = Product::create($data);
            $product->detail()->create($data_detail);
            $product->categories()->attach($categories);
        }

        if (request()->hasFile('product_image')) {
            $this->validate(request(), [
                'product_image' => 'image | mimes: png,jpg,jpeg,gif | max:2048'
            ]);

            $product_image = request()->file('product_image');
            $file_name = $product->id . '-' . time() . '.' . $product_image->extension();
            if ($product_image->isValid()) {
                $product_image->move('uploads/product/', $file_name);
                ProductDetail::updateOrCreate(
                    ['product_id' => $product->id],
                    ['product_image' => $file_name]
                );
            }
        }

        $message = $id > 0 ? 'Product Updated' : 'Product Added';
        return redirect()->route('admin.product-update', $product->id)
            ->with('message', $message)
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('admin.products')
            ->with('message', 'Row Deleted')
            ->with('message_type', 'success');
    }
}
