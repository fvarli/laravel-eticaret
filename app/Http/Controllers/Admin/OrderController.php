<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {

        if (request()->filled('search')) {
            request()->flash();
            $search = request('search');
            $order_list = ProductOrder::with('box.user')->where('full_name', 'like', "%$search%")
                ->orWhere('bank', 'like', "%$search%")
                ->orWhere('id',$search)
                ->orderByDesc('id')
                ->paginate(10)
                ->appends(['search' => $search]);
        } else {
            request()->flush();
            $order_list = ProductOrder::with('box.user')->orderByDesc('id')->paginate(10);
        }
        // print_r($order_list); die();

        return view('admin.order.index', compact('order_list'));
    }

    public function form($id = null)
    {
        $list = new Product;
        $product_categories = [];
        if ($id != null) {
            $list = Product::find($id);
            $product_categories = $list->category()->pluck('category_id')->all();
        }

        // dd($product_categories);
        $categories = Category::all();
        // dd($categories);

        return view('admin.product.form', compact('list', 'categories', 'product_categories'));
    }

    public function save($id = null)
    {
        $data = request()->only('slug', 'product_name', 'price', 'description');
        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('product_name'));
            request()->merge(['slug' => $data['slug']]);
        }
        $this->validate(request(), [
            'product_name' => 'required',
            'price' => 'required',
            'slug' => (request('original_slug') != request('slug') ? 'unique:category,slug' : '')
        ]);

        // dd(request('show_slider'));

        $data_detail = request()->only('show_slider', 'show_today_opportunity', 'show_featured', 'show_best_seller', 'show_discount');

        $categories = request('categories');

        //dd($categories);

        if ($id != null) {
            $list = Product::where('id', $id)->firstOrFail();
            $list->update($data);
            $list->detail()->update($data_detail);
            $list->category()->sync($categories);

        } else {
            $list = Product::create($data);
            $list->detail()->create($data_detail);
            $list->category()->attach($categories);
        }

        if(request()->hasFile('product_image')){
            $this->validate(request(), [
               'product_image' => 'image|mimes:jpg,png,jpeg,gif|max:2048'
            ]);

            $product_image = request()->file('product_image');
            $file_name = $list->id . '-' . time() . '.' . $product_image->extension();
            // $file_name = $product_image->getClientOriginalName();
            // $file_name = $product_image->hashName();

            if($product_image->isValid()){
                $product_image->move('uploads/products', $file_name);
                ProductDetail::updateOrCreate(
                   ['product_id' => $list->id],
                   ['product_image' => $file_name]
                );
            }
        }

        return redirect()
            ->route('admin.product.edit', $list->id)
            ->with('message_type', 'success')
            ->with('message', ($id != null ? 'Updated' : 'Saved'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->category()->detach();
        $product_delete = $product->delete();

        if ($product_delete) {
            return redirect()
                ->route('admin.product')
                ->with('message_type', 'success')
                ->with('message', 'Category has been deleted');
        } else {
            return redirect()
                ->route('admin.product')
                ->with('message_type', 'error')
                ->with('message', 'Category couldn\'t deleted');
        }
    }
}
