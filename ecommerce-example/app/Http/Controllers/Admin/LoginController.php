<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {

        if (Auth::guard('admin')->user()) {
            return redirect()->route('admin.index');
        }

        if (request()->isMethod('POST')) {
            $this->validate(request(), [
                'email' => 'required | email',
                'password' => 'required'
            ]);

            $infos = [
                'email' => request('email'),
                'password' => request('password'),
                'isAdmin' => 1
            ];

            if (Auth::guard('admin')->attempt($infos, request()->has('rememberme'))) {
                return redirect()->route('admin.index');
            } else {
                return back()->withInput()->withErrors(['email' => 'Invalid email']);
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        if (request()->isMethod('GET')) {
            return response()->view('errors.404');
        }

        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('user.index');
    }
}
