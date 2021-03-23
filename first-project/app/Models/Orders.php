<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['cart_id', 'price', 'bank', 'installment', 'statu', 'full_name', 'address', 'phone', 'phone2'];

    public function cart()
    {
        return $this->belongsTo('App\Models\ShoppingCart');
    }
}
