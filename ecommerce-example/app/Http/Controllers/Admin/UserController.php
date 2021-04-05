<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('detail')->orderBy('name')->get();
        return view('admin.user.users', compact('users'));
    }

    public function update($id)
    {
        if (request()->isMethod('POST')) {
            $this->validate(request(), [
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required | email',
                'phone' => 'required',
                'address' => 'required'
            ]);

            $user = [
                'name' => request('name'),
                'surname' => request('surname'),
                'email' => request('email'),
                'isAdmin' => request()->has('isAdmin') ? 1 : 0,
            ];
            if (request()->has('active')) {
                $user['activation_key'] = null;
            }

            $user_detail = [
                'phone' => request('phone'),
                'address' => request('address')
            ];

            User::where('id', $id)->update($user);
            UserDetail::where('user_id', $id)->update($user_detail);

            return back()->with('message', 'Succesfully Updated')
                ->with('message_type', 'success');
        }

        $user = User::with('detail')->where('id', $id)->firstOrFail();
        return view('admin.user.user-detail', compact('user'));
    }
}
