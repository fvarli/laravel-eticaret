<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $product_orders = ProductOrder::with('box')
            ->whereHas('box', function ($query){
                $query->where('user_id', auth()->id());
            })
            ->orderByDesc('created_at')
            ->get();

        // print_r($product_orders);die();

        return view('orders', compact('product_orders'));
    }

    public function detail($id)
    {
        $order_detail = ProductOrder::with('box.box_products.product')
            ->whereHas('box', function ($query){
                $query->where('user_id', auth()->id());
            })
            ->where('product_order.id', $id)
            ->firstOrFail();
        // print_r($order_detail);die();
        return view('order_detail', compact('order_detail'));
    }
}
