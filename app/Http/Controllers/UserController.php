<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login_form()
    {
        return view('user.login');
    }

    public function sign_up_form()
    {
        return view('user.sign_up');
    }

    public function sign_up()
    {

        $this->validate(request(),[
            'full_name' => 'required|min:5|max:60',
            'email' => 'required|email|unique:user',
            'password' => 'required|confirmed|min:5|max:15',
        ]);

        $user = User::create([
            'full_name' => request('full_name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'password_confirmation' => request('password_confirmation'),
            'activation_code' => Str::random(60),
            'is_active' => 0
        ]);

        auth()->login($user);
        return redirect()->route('home');
    }
}
