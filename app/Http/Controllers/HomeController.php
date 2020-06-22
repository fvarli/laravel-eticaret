<?php

namespace App\Http\Controllers;

class HomeController extends Controller{
    public function index()
    {
        $first_name = 'John';
        $last_name = 'Doe';
        // return view('home', ['name' => 'John Doe']);
        return view('home', compact( 'first_name', 'last_name'));
        // return view('home')->with(['first_name' => $first_name, 'last_name' => $last_name]);
    }
}
