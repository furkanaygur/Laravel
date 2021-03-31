<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
        Cart::add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug, 'category' => $category]);
        return redirect()->route('cart')->with('message', 'Successfully Added.')
            ->with('message_type', 'success');
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart')->with('message', 'Successfully Deleted.')
            ->with('message_type', 'success');
    }

    public function clear()
    {
        Cart::destroy();

        return redirect()->route('cart')->with('message', 'Cart Cleared.')
            ->with('message_type', 'success');
    }

    public function update($rowId)
    {
        Cart::update($rowId, request('piece'));
        return response()->json();
    }
}
