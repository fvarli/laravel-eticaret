<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug_category_name)
    {
        $category = Category::where('slug', $slug_category_name)->firstOrFail();
        $sub_category = Category::where('cat_id', $category->id)->get();

        $order = request('order');
        if($order == 'bestseller'){
            $products = $category->products()
                ->distinct()
                ->join('product_detail','product_detail.product_id', 'product.id')
                // ->where('product_detail.show_best_seller', 1)
                ->orderBy('product_detail.show_best_seller', 'desc')
                ->paginate(4);
        }elseif ($order == 'new'){
            $products = $category->products()->distinct()->orderByDesc('updated_at')->paginate(4);
        }else{
            $products = $category->products()->distinct()->paginate(4);
        }

        return view('category', compact('category','sub_category', 'products'));
    }
}
