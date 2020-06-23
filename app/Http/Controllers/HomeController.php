<?php

namespace App\Http\Controllers;

class HomeController extends Controller{
    public function index()
    {
        $first_name = 'John';
        $last_name = 'Doe';

        $names = ['Fred','Jone', 'Jane'];

        $users = [
            ['id'=>1, 'user_name' => 'Fred'],
            ['id'=>2, 'user_name' => 'Jone'],
            ['id'=>3, 'user_name' => 'Jane'],
            ['id'=>4, 'user_name' => 'Test']
        ];

        // return view('home', ['name' => 'John Doe']);
        return view('home', compact( 'first_name', 'last_name', 'names', 'users'));
        // return view('home')->with(['first_name' => $first_name, 'last_name' => $last_name]);
    }
}
