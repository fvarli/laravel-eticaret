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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    Route::redirect('/', 'admin/login');
    Route::match(['get', 'post'],'/login', 'UserController@login')->name('admin.login');
    Route::get('/logout', 'UserController@logout')->name('admin.logout');
    Route::group(['middleware' => 'admin'], function (){

        Route::get('/home', 'HomeController@index')->name('admin.home');

        Route::group(['prefix' => 'user'], function (){
           Route::match(['get', 'post'], '/', 'UserController@index')->name('admin.user');
           Route::get('/new_user', 'UserController@form')->name('admin.user.new_user');
           Route::get('/edit/{id}', 'UserController@form')->name('admin.user.edit');
           Route::post('/save/{id?}', 'UserController@save')->name('admin.user.save');
           Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
        });
    });

});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{slug_category_name}', 'CategoryController@index')->name('category');
Route::get('/product/{slug_product_name}', 'ProductController@index')->name('product');

Route::group(['prefix' => 'box'], function (){
    Route::get('/', 'BoxController@index')->name('box');
    Route::post('/add', 'BoxController@add')->name('box.add');
    Route::delete('/remove/{row_id}', 'BoxController@remove')->name('box.remove');
    Route::delete('/remove_box', 'BoxController@remove_box')->name('box.remove_box');
    Route::patch('/update/{row_id}', 'BoxController@update')->name('box.update');
});

// Route::get('/box/', 'BoxController@index')->name('box')->middleware('auth');
Route::get('/payment/', 'PaymentController@index')->name('payment');
Route::post('/payment/pay', 'PaymentController@pay')->name('pay');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/orders', 'OrdersController@index')->name('orders');
    Route::get('/orders/{id}', 'OrdersController@detail')->name('order');
});
Route::post('/search', 'ProductController@search')->name('search_product');
Route::get('/search', 'ProductController@search')->name('search_product');

Route::group(['prefix' => 'user'], function (){
    Route::get('/login', 'UserController@login_form')->name('user.login');
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout')->name('user.logout');
    Route::get('/sign_up', 'UserController@sign_up_form')->name('user.sign_up');
    Route::post('/sign_up', 'UserController@sign_up');
    Route::get('/active/{key}', 'UserController@active')->name('active');
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
