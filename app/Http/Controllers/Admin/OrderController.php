<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductOrder;
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
                ->orWhere('id', $search)
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

        if ($id != null) {
            $list = ProductOrder::with('box.box_products.product')->find($id);
        }

        // dd($list);

        return view('admin.order.form', compact('list'));
    }

    public function save($id = null)
    {
        $this->validate(request(), [
            'full_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'status' => 'required'
        ]);

        $data = request()->only('full_name', 'address', 'phone', 'cell_phone', 'status');

        // dd($data);

        if ($id != null) {
            $list = ProductOrder::where('id', $id)->firstOrFail();
            $list->update($data);
        }

        return redirect()
            ->route('admin.order.edit', $list->id)
            ->with('message_type', 'success')
            ->with('message', ('Updated'));
    }

    public function delete($id)
    {
        ProductOrder::destroy($id);

        return redirect()
            ->route('admin.order')
            ->with('message_type', 'success')
            ->with('message', 'Category has been deleted');

    }
}
