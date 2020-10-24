<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{

    public function login()
    {
        if(request()->isMethod('POST')){
            $this->validate(request(),[
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
              'email' => request()->get('email'),
              'password' => request()->get('password'),
              'is_admin' => 1
            ];

            if(Auth::guard('admin')->attempt($credentials, request()->has('remember_me'))){
                return redirect()->route('admin.home');
            }else{
                return back()->withInput()->withErrors(['email' => 'Email is not correct. - or', 'password' => 'Password is not correct. - or', 'is_admin' => 'The user is not an admin.']);
            }
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
