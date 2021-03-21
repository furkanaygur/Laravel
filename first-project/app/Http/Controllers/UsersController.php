<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function Login()
    {
        return view('users.login');
    }

    public function signin_form()
    {
        return view('users.signin');
    }

    public function signin()
    {
        $user = Users::create([
            'full_name' => request('full_name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'activation_key' => Str::random(60),
            'isActive' => 0
        ]);

        auth()->login($user);

        return redirect()->route('index');
    }
}
