<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\ShoppingCart;
use App\Models\Product;
use Cart;
use Validator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('cart');
    }

    public function add_product()
    {
        $product = Product::find(request('id'));
        $cart_item = Cart::add($product->id, $product->product_name, 1, $product->price, ['slug' => $product->slug]);

        if (Auth::check()) {
            $cart_id = session('cart_id');
            if (!isset($cart_id)) {
                $cart = ShoppingCart::create([
                    'user_id' => Auth::id(),
                ]);
                $cart_id = $cart->id;
                session()->put('cart_id', $cart_id);
            }

            CartProduct::updateOrCreate(
                ['cart_id' => $cart_id, 'product_id' => $product->id],
                ['piece' => $cart_item->qty, 'price' => $product->price, 'statu' => 'Waiting']
            );
        }
        return redirect()->route('cart')
            ->with('message', 'Successfully Added')
            ->with('message_type', 'success');
    }

    public function delete_product($rowId)
    {
        if (Auth::check()) {
            $cart_id = session('cart_id');
            $cart_product = Cart::get($rowId);
            CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->delete();
        }

        Cart::remove($rowId);
        return redirect()->route('cart')
            ->with('message', 'Successfully Deleted')
            ->with('message_type', 'success');
    }

    public function clear_cart()
    {
        if (Auth::check()) {
            $cart_id = session('cart_id');
            CartProduct::where('cart_id', $cart_id)->delete();
        }

        Cart::destroy();

        return redirect()->route('cart')
            ->with('message', 'Shoppingcart is clean')
            ->with('message_type', 'success');
    }

    public function update($rowId)
    {
        $validator = Validator::make(request()->all(), [
            'piece' => 'required | numeric'
        ]);
        if ($validator->fails()) {
            session()->flash('message', 'Invalid values.');
            session()->flash('message_type', 'danger');
            return response()->json(['success' => false]);
        }

        if (Auth::check()) {
            $cart_id = session('cart_id');
            $cart_product = Cart::get($rowId);
            if (request('piece') == 0) {
                CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->delete();
            } else {
                CartProduct::where('cart_id', $cart_id)->where('product_id', $cart_product->id)->update(
                    ['piece' => request('piece')]
                );
            }
        }

        Cart::update($rowId, request('piece'));

        // session()->flash('message', 'Updated');
        // session()->flash('message_type', 'success');

        return response()->json(['success' => true]);
    }
}
