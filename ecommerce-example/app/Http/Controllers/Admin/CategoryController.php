<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->orderByDesc('created_at')->get();
        return view('admin.category.categories', compact('categories'));
    }

    public function update($id)
    {
        return $id;
    }
}
