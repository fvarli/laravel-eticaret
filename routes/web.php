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

Route::get('/category/{slug_category_name}', 'CategoryController@index')->name('category');
Route::get('/product/{slug_product_name}', 'ProductController@index')->name('product');
Route::get('/box/', 'BoxController@index')->name('box');
Route::get('/payment/', 'PaymentController@index')->name('payment');
Route::get('/orders/', 'OrdersController@index')->name('orders');
Route::get('/order_detail/{id}', 'OrdersController@detail')->name('order_detail');
Route::post('/search', 'ProductController@search')->name('search_product');
Route::get('/search', 'ProductController@search')->name('search_product');

Route::group(['prefix' => 'user'], function (){
    Route::get('/login', 'UserController@login_form')->name('user.login');
    Route::get('/sign_up', 'UserController@sign_up_form')->name('user.sign_up');
    Route::post('/sign_up', 'UserController@sign_up');
});

Route::get('/test/email', function (){
    $user = \App\Models\User::find(1);
   return new App\Mail\UserRegister($user);
});

/*
Route::view('/category', 'category');
Route::view('/product', 'product');
Route::view('/box', 'box');
*/
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
