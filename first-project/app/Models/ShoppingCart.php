<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ShoppingCart extends Model
{
    use SoftDeletes;
    protected $table = 'cart';
    protected $guarded = [];

    public function orders()
    {
        return $this->hasOne('App\Models\Orders');
    }

    public function cart_product()
    {
        return $this->hasMany('App\Models\CartProduct', 'cart_id');
    }

    public static function cart_id()
    {
        $cart_id = DB::table('cart as c')
            ->leftJoin('orders as o', 'o.cart_id', '=', 'c.id')
            ->where('c.user_id', auth()->id())
            ->whereRaw('o.id is null')
            ->orderByDesc('c.created_at')
            ->select('c.id')->first();

        if (!is_null($cart_id)) return $cart_id->id;
    }

    public function cart_product_piece()
    {
        return DB::table('cart_product')->where('cart_id', $this->id)->whereRaw('deleted_at is null')->sum('piece');
    }
}
