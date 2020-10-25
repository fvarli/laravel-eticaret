<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {

        if (request()->filled('search') || request()->filled('search_cat_id')) {
            request()->flash();
            $search = request('search');
            $search_cat_id= request('search_cat_id');
            $category_list = Category::with('primary_category')
                ->where('category_name', 'like', "%$search%")
                ->where('cat_id', $search_cat_id)
                ->orderByDesc('id')
                ->paginate(10)
                ->appends(['search' => $search, 'search_cat_id' => $search_cat_id]);
        } else {
            request()->flush();
            $category_list = Category::with('primary_category')->orderByDesc('id')->paginate(10);
        }
        //print_r($category_list);

        $primary_categories = Category::whereRaw('cat_id is null')->get();
        //  print_r($categories);die();
        return view('admin.category.index', compact('category_list', 'primary_categories'));
    }

    public function form($id = null)
    {
        $list = new Category;
        if ($id != null) {
            $list = Category::find($id);
        }

        $categories = Category::all();

        return view('admin.category.form', compact('list', 'categories'));
    }

    public function save($id = null)
    {
        $data = request()->only('cat_id', 'slug','category_name');
        if(!request()->filled('slug')){
            $data['slug'] = str_slug(request('category_name'));
            request()->merge(['slug' => $data['slug']]);
        }
        $this->validate(request(), [
            'category_name' => 'required',
            'slug' => (request('original_slug') != request('slug') ? 'unique:category,slug' : '')
        ]);


        if ($id != null) {
            $list = Category::where('id', $id)->firstOrFail();
            $list->update($data);
        } else {
            $list = Category::create($data);
        }


        return redirect()
            ->route('admin.category.edit', $list->id)
            ->with('message_type', 'success')
            ->with('message', ($id != null ? 'Updated' : 'Saved'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->products()->detach();
        $category_delete = $category->delete();

        if ($category_delete) {
            return redirect()
                ->route('admin.category')
                ->with('message_type', 'success')
                ->with('message', 'Category has been deleted');
        } else {
            return redirect()
                ->route('admin.category')
                ->with('message_type', 'error')
                ->with('message', 'Category couldn\'t deleted');
        }
    }
}
