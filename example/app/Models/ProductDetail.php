<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_detail';
    protected $guarded = [];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
