<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cart_product';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
