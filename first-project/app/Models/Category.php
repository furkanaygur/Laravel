<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';
    // protected $fillable = ['category_name', 'slug'];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'category_product');
    }
}