<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_product', 'category_id', 'product_id');
    }
}
