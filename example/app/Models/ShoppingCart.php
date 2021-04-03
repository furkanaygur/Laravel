<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cart';
    protected $guarded = [];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function cart_id()
    {
        $cart_id = DB::table('cart as c')
            ->leftJoin('order as o', 'o.cart_id', '=', 'c.id')
            ->where('c.user_id', auth()->id())
            ->whereRaw('o.id is null')
            ->orderByDesc('c.created_at')
            ->select('c.id')
            ->first();
    }
}
