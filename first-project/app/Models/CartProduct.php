<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
    use SoftDeletes;
    protected $table = 'cart_product';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
