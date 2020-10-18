<?php

namespace App\Http\Controllers;

use App\Mail\UserRegister;
use App\Models\BoxProduct;
use App\Models\Box;
use App\Models\User;
use Cart;
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

            $active_box_id = Box::firstOrCreate(['user_id' => auth()->id()])->id;
            session()->put('active_box_id', $active_box_id);

            if(Cart::count()>0){
                foreach (Cart::content() as $cart_item){
                    BoxProduct::updateOrCreate(
                      ['box_id' => $active_box_id, 'product_id' => $cart_item->id],
                      ['piece' => $cart_item->qty, 'price' => $cart_item->price, 'status' => 'Pending']
                    );
                }
            }

            Cart::destroy();

            $box_products = BoxProduct::where('box_id', $active_box_id)->get();
            foreach ($box_products as $box_product){
                Cart::add($box_product->product->id, $box_product->product->product_name, $box_product->piece, $box_product->price, ['slug' => $box_product->product->slug]);
            }

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
