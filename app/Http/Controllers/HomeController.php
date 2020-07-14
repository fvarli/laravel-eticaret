<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller{
    public function index()
    {
        $categories = Category::whereRaw('cat_id is null')->take(6)->get();

        $products_slider = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_slider',1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        $show_today_opportunity = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_today_opportunity',1)
            ->orderBy('updated_at', 'desc')
            ->first();

        $products_featured = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_featured',1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        $products_best_seller = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_best_seller',1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        $products_discount = Product::select('product.*')
            ->join('product_detail', 'product_detail.product_id', 'product.id')
            ->where('product_detail.show_discount',1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        return view('home', compact('categories', 'products_slider', 'show_today_opportunity', 'products_featured', 'products_best_seller', 'products_discount'));

        /*$first_name = 'John';
        $last_name = 'Doe';

        $names = ['Fred','Jone', 'Jane'];

        $users = [
            ['id'=>1, 'user_name' => 'Fred'],
            ['id'=>2, 'user_name' => 'Jone'],
            ['id'=>3, 'user_name' => 'Jane'],
            ['id'=>4, 'user_name' => 'Test']
        ];

        return view('home', ['name' => 'John Doe']);
        return view('home', compact( 'first_name', 'last_name', 'names', 'users'));
        return view('home')->with(['first_name' => $first_name, 'last_name' => $last_name]);
        */
    }
}
