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

    public function search()
    {
        $search_product = request()->input('search_product');
        $products = Product::where('product_name', 'like',"%$search_product%")
            ->orWhere('description', 'like', "%$search_product%")
            ->paginate(4);
        request()->flash();
        return view('search', compact('products'));
    }
}
