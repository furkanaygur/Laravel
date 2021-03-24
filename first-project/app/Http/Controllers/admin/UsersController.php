<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function Login()
    {
        if (Auth::guard('admin')->user()) {
            return redirect()->route('admin.index');
        }

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
                'isAdmin' => 1,
                'isActive' => 1
            ];
            if (Auth::guard('admin')->attempt($credentials, request()->has('remember_me'))) {
                return redirect()->route('admin.index');
            } else {
                return back()->withInput()->withErrors(['email' => 'Invalid email address ', 'password' => 'Invalid password']);
            }
        }
        return view('admin.login');
    }

    public function Logout()
    {
        if (request()->isMethod('GET')) {
            return response()->view('errors.404');
        }
        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        if (request()->filled('search_key')) {
            request()->flash();
            $search_key = request('search_key');
            $users = Users::where('full_name', 'LIKE', '%' . $search_key . '%')
                ->orWhere('email', 'lIKE', '%' . $search_key . '%')
                ->orderByDesc('created_at')->paginate(8)->appends('search_key', $search_key);
        } else {
            $users = Users::orderByDesc('created_at')->paginate(8);
        }
        return view('admin.user.index', compact('users'));
    }

    public function form($id = 0)
    {
        $user = new Users;
        if ($id > 0) {
            $user = Users::find($id);
        }

        return view('admin.user.form', compact('user'));
    }

    public function save($id = 0)
    {
        $this->validate(request(), [
            'full_name' => 'required',
            'email' => 'required | email',
        ]);

        $data = request()->only('full_name', 'email');
        if (request()->filled('password')) {
            $data['password'] = Hash::make(request('password'));
        }
        $data['isActive'] = request()->has('isActive') && request('isActive') == 1 ? 1 : 0;
        $data['isAdmin'] = request()->has('isAdmin') && request('isAdmin') == 1 ? 1 : 0;

        if ($id > 0) {
            $user = Users::where('id', $id)->firstOrFail();
            $user->update($data);
        } else {
            $user = Users::create($data);
        }

        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => request('address'),
                'phone' => request('phone'),
                'phone2' => request('phone2')
            ]
        );

        $message = $id > 0 ? 'User Updated' : 'User Added';
        return redirect()->route('admin.user-update', $user->id)
            ->with('message', $message)
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        Users::destroy('user_id', $id);

        return redirect()->route('admin.users')
            ->with('message', 'Row Deleted')
            ->with('message_type', 'success');
    }
}
