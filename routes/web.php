<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/hello_world', function (){
   return "Hello World";
});

Route::get('/api/v1/hello_world', function (){
   return ['message' => 'Hello World'];
});

Route::get('/product/{product_name}/{id?}', function ($product_name, $id=null){
    return "Product Name: $id $product_name";
})->name('product_detail');

Route::get('/campaign', function (){
   return redirect()->route('product_detail', ['product_name' => 'test', 'id' =>1]);
});
