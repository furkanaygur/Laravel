<?php

namespace App\Http\Controllers;

use App\Mail\UserActivationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
            return redirect()->intended('/');
        } else {
            // $errors = ['email' => 'Could not login'];
            // return back()->withErrors($errors);
            return redirect()->route('user.lr')
                ->with('message', 'Could not login. Please try again')
                ->with('message_type', 'danger')->withInput();
        }
    }

    public function Signin()
    {
        $this->validate(request(), [
            'name' => 'required | min:3 | max:60',
            'email' => 'required | email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60)
        ]);

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
