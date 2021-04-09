<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'category_product', 'category_id', 'product_id');
    }

    public function parent_category($id)
    {
        $parent = Category::where('id', $id)->first();

        if (!is_null($parent)) {
            return $parent->name;
        }
        return '-';
    }
}
