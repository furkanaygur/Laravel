<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->filled('search_key') || request()->filled('byParent_category')) {
            request()->flash();
            $search_key = request('search_key');
            $byParent_category = request('byParent_category');
            $categories = Category::with('parent_category')->where('category_name', 'LIKE', '%' . $search_key . '%')
                ->where('parent_id', $byParent_category)
                ->orderByDesc('created_at')->paginate(8)->appends(['search_key' => $search_key, 'byParent_category' => $byParent_category]);
        } else {
            request()->flush();
            $categories = Category::with('parent_category')->orderByDesc('created_at')->paginate(8);
        }

        $parent_categories = Category::whereRaw('parent_id is null')->get();
        return view('admin.category.index', compact('categories', 'parent_categories'));
    }

    public function form($id = 0)
    {
        $category = new Category;
        if ($id > 0) {
            $category = Category::find($id);
        }

        $all_categories = Category::all();

        return view('admin.category.form', compact('category', 'all_categories'));
    }

    public function save($id = 0)
    {


        $data = request()->only('slug', 'category_name', 'parent_id');

        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('category_name'));
            request()->merge(['slug' => $data['slug']]);
        }

        $this->validate(request(), [
            'category_name' => 'required',
            'slug' => request('original_slug') != request('slug') ? 'unique:category,slug' : ''
        ]);

        if ($id > 0) {
            $category = Category::where('id', $id)->firstOrFail();
            $category->update($data);
        } else {
            $category = Category::create($data);
        }

        $message = $id > 0 ? 'Category Updated' : 'Category Added';
        return redirect()->route('admin.category-update', $category->id)
            ->with('message', $message)
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->products->detach();
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('message', 'Row Deleted')
            ->with('message_type', 'success');
    }
}
