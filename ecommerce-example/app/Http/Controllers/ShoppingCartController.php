<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Products;
use App\Models\ShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add()
    {
        $product = Products::with(['categories', 'detail'])->find(request('id'));
        $category = $product->categories->first();
        $category = $category->slug;
        $item = Cart::add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug, 'category' => $category]);

        if (Auth::check()) {
            $cart_id = session('cart_id');;
            if (is_null($cart_id)) {
                $user_cart = ShoppingCart::create([
                    'user_id' => auth()->id()
                ]);
                $cart_id = $user_cart->id;
                session()->put('cart_id', $cart_id);
            }

            CartProduct::updateOrCreate(
                ['cart_id' => $cart_id, 'product_id' => $product->id],
                ['piece' => $item->qty, 'price' => $product->price, 'statu' => 'Waiting']
            );
        }
        return redirect()->route('cart')->with('message', 'Successfully Added.')
            ->with('message_type', 'success');
    }

    public function delete($rowId)
    {
        if (auth()->check()) {
            $cart_id = session('cart_id');
            $cart_product = Cart::get($rowId);
            CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->delete();
        }
        Cart::remove($rowId);
        return redirect()->route('cart')->with('message', 'Successfully Deleted.')
            ->with('message_type', 'success');
    }

    public function clear()
    {
        Cart::destroy();
        if (auth()->check()) {
            $cart_id = session('cart_id');
            CartProduct::where('cart_id', $cart_id)->delete();
        }
        return redirect()->route('cart')->with('message', 'Cart Cleared.')
            ->with('message_type', 'success');
    }

    public function update($rowId)
    {

        if (auth()->check()) {
            $cart_id = session('cart_id');
            $cart_product = Cart::get($rowId);
            if (request('piece') == 0) {
                CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->delete();
            } else {
                CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->update([
                    'piece' => request('piece')
                ]);
            }
        }
        Cart::update($rowId, request('piece'));

        return response()->json();
    }
}
