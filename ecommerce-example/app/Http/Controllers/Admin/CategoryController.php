<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->orderByDesc('created_at')->get();
        return view('admin.category.categories', compact('categories'));
    }

    public function update($id)
    {
        if (request()->isMethod('POST')) {

            $this->validate(request(), [
                'name' => 'required'
            ]);

            $category = [
                'name' => request('name')
            ];

            if (request('slug') != "") {
                $category['slug'] = Str::slug(request('slug'));
            } else {
                $category['slug'] = Str::slug(request('name'));
            }
            if (request()->has('parent_id')) {
                $category['parent_id'] = request('parent_id');
            }

            Category::where('id', $id)->update($category);

            return back()->with('message', 'Succesfully Updated')
                ->with('message_type', 'success');
        }

        $category = Category::with('products')->where('id', $id)->firstOrFail();
        $categories = Category::where('id', '!=', $id)->get();
        return view('admin.category.category-detail', compact('category', 'categories'));
    }

    public function add_category()
    {
        if (request()->isMethod('POST')) {

            $this->validate(request(), [
                'name' => 'required',
            ]);

            $category = [
                'name' => request('name'),
            ];

            if (request('slug') != "") {
                $category['slug'] = Str::slug(request('slug'));
            } else {
                $category['slug'] = Str::slug(request('name'));
            }
            if (request()->has('parent_id')) {
                $category['parent_id'] = request('parent_id');
            }

            Category::insert($category);

            return redirect()->route('admin.categories')->with('message', 'Succesfully Added')
                ->with('message_type', 'success');
        }
        
        $categories = Category::all();
        return view('admin.category.add-category', compact('categories'));
    }
}
