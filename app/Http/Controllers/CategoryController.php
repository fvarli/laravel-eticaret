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
        return view('category', compact('category','sub_category'));
    }
}
