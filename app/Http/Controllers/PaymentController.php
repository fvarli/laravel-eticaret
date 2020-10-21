<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Cart;

class PaymentController extends Controller
{
    public function index()
    {

        if(!auth()->check()){
            return redirect()->route('user.login')
                ->with('message_type', 'info')
                ->with('message', 'For payment, you need to login.');
        }else if (count(Cart::content()) == 0){
            return redirect()->route('home')
                ->with('message_type', 'info')
                ->with('message', 'For payment, you need to have items.');
        }

        $user_detail = auth()->user()->user_detail;

        return view('payment', compact('user_detail'));
    }

    public function pay()
    {
        $order = request()->all();
        $order['box_id'] = session('active_box_id');
        $order['bank'] = "Enpara";
        $order['installment'] = 1;
        $order['status'] = "Payment has been received.";
        $order['order_price'] = Cart::subtotal();

        ProductOrder::create($order);
        Cart::destroy();
        session()->forget('active_box_id');

        return redirect()->route('orders')
            ->with('message_type', 'success')
            ->with('message', 'Your payment has been successfully completed.');
    }
}
