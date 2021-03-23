<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function Login()
    {
        if (request()->isMethod('POST')) {
            $this->validate(
                request(),
                [
                    'email' => 'required | email',
                    'password' => 'required'
                ]
            );

            $credentials = [
                'email' => request('email'),
                'password' => request('password'),
                'isAdmin' => 1
            ];
            if (Auth::attempt($credentials, request()->has('remember_me'))) {
                return redirect()->route('admin.index');
            } else {
                return back()->withInput()->withErrors(['email' => 'Invalid values', 'password' => 'Invalid values']);
            }
        }
        return view('admin.login');
    }
}
