<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($slug_product_name)
    {
        $product = Product::whereSlug($slug_product_name)->firstOrFail();
        $category = $product->category()->distinct()->get();
        return view('product', compact('product', 'category'));
    }
}
