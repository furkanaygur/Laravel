<?php

namespace App\Http\Controllers;

use App\Mail\UserActivationMail;
use App\Models\CartProduct;
use App\Models\Products;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('login-register');
    }

    public function Login()
    {
        $this->validate(request(), [
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $values = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (Auth::attempt($values, request()->has('rememberme'))) {
            request()->session()->regenerate();

            $cart_id = ShoppingCart::cart_id();
            if (is_null($cart_id)) {
                $cart = ShoppingCart::create(['user_id' => auth()->id()]);
                $cart_id = $cart->id;
            }

            session()->put('cart_id', $cart_id);

            if (Cart::count() > 0) {
                foreach (Cart::content() as $cart_product) {
                    CartProduct::updateOrCreate(
                        ['cart_id' => $cart_id, 'product_id' => $cart_product->id],
                        ['piece' => $cart_product->qty, 'price' => $cart_product->price, 'statu' => 'Waiting']
                    );
                }
            }
            Cart::destroy();
            $cart_products = CartProduct::with('product')->where('cart_id', $cart_id)->get();

            foreach ($cart_products as $cart) {
                $product = Products::with('categories')->where('id', $cart->product->id)->first();
                Cart::add($cart->product->id, $cart->product->title, $cart->piece, $cart->price, ['slug' => $cart->product->slug, 'category' => $product->categories[0]->slug]);
            }

            return redirect()->intended('/');
        } else {
            return redirect()->route('user.login.form')
                ->with('message', 'Could not login. Please try again')
                ->with('message_type', 'danger')->withInput();
        }
    }

    public function Signin()
    {
        $this->validate(request(), [
            'name' => 'required | min:3 | max:60',
            'surname' => 'required | min:3 | max:60',
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60)
        ]);

        $user->detail()->save(new UserDetail());
        Mail::to($user->email)->send(new UserActivationMail($user));

        Auth::login($user);

        return redirect()->route('user.index')->with('message', 'Please confirm your email address.')
            ->with('message_type', 'info');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('user.index');
    }

    public function activation($key)
    {
        $user = User::where('activation_key', $key)->first();
        if (!is_null($user)) {
            $user->activation_key = null;
            $user->save();

            return redirect()->route('user.index')->with('message', 'E-mail address has been verified.')
                ->with('message_type', 'success');
        } else {
            return redirect()->route('user.index')->with('message', 'Email address could not be verified. Please try again.')
                ->with('message_type', 'danger');
        }
    }
}
