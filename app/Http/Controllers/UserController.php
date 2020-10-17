<?php

namespace App\Http\Controllers;

use App\Mail\UserRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_form()
    {
        return view('user.login');
    }

    public function login()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(auth()->attempt(['email' => request('email'), 'password' => request('password')], request()->has('remember_me'))){
            request()->session()->regenerate();
            return redirect()->intended('/');
        } else {
            $errors = ['email' => 'Login Error'];
            return back()->withErrors($errors);
        }
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

        Mail::to(request('email'))->send(new UserRegister($user));

        auth()->login($user);
        return redirect()->route('home');
    }

    public function active($key)
    {
        // TODO active email user
        $user = User::where('activation_code', $key)->first();
        if(!is_null($user)){
            $user->activation_code = null;
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/')
                ->with('message', 'Your account has been activated.')
                ->with('message_type', 'success');
        }else{
            return redirect()->to('/')
                ->with('message', 'Could not be activated a user record.')
                ->with('message_type', 'warning');
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('home');
    }
}
