<?php

namespace App\Http\Controllers;

use App\Mail\userSinginMail;
use App\Models\CartProduct;
use App\Models\ShoppingCart;
use App\Models\UserDetail;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Cart;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['Logout', 'activation']);
    }

    public function Login_form()
    {
        return view('users.login');
    }

    public function Login()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')], request()->has('remember_me'))) {
            request()->session()->regenerate();

            $cart_id = ShoppingCart::cart_id();
            if (is_null($cart_id)) {
                $cart = ShoppingCart::create(['user_id' => auth()->id()]);
                $cart_id = $cart->id;
            }
            session()->put('cart_id', $cart_id);

            if (Cart::count() > 0) {
                foreach (Cart::content() as $cart_item) {
                    CartProduct::updateOrCreate(
                        ['cart_id' => $cart_id, 'product_id' => $cart_item->id],
                        ['piece' => $cart_item->qty, 'price' => $cart_item->price, 'statu' => 'Waiting']
                    );
                }
            }

            Cart::destroy();
            $cart_items = CartProduct::with('product')->where('cart_id', $cart_id)->get();
            foreach ($cart_items as $item) {
                Cart::add($item->product->id, $item->product->product_name, $item->piece, $item->product->price, ['slug' => $item->product->slug]);
            }

            return redirect()->intended('/');
        } else {
            $errors = ['email' => 'Invalid values'];

            return back()->withErrors($errors);
        }
    }

    public function signin_form()
    {
        return view('users.signin');
    }

    public function signin()
    {
        $this->validate(request(), [
            'full_name' => 'required | min:5 | max:60',
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed | min:5',
        ]);
        $user = Users::create([
            'full_name' => request('full_name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60),
            'isActive' => 0
        ]);

        $user->detail()->save(new UserDetail());

        Mail::to(request('email'))->send(new userSinginMail($user));

        Auth::login($user);


        return redirect()->route('index');
    }

    public function activation($key)
    {
        $user = Users::where('activation_key', $key)->first();
        if (!is_null($user)) {
            $user->activation_key = null;
            $user->isActive = 1;
            $user->save();
            return redirect()->to('/')->with('message', 'Successfully Activated')
                ->with('message_type', 'success');
        } else {
            return redirect()->to('/')->with('message', 'Couldn\'t activate ')->with('message_type', 'danger');
        }
    }

    public function Logout()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('index');
    }
}
