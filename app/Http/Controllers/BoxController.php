<?php

namespace App\Http\Controllers;

use App\Models\BoxProduct;
use App\Models\Product;
use App\Models\Box;
use Cart;
use Validator;
use Illuminate\Http\Request;

class BoxController extends Controller
{

    public function index()
    {
        return view('box');
    }

    public function add()
    {
        $product = Product::find(request('id'));
        $cart_item = Cart::add($product->id, $product->product_name, 1, $product->price, ['slug' => $product->slug]);

        if(auth()->check()){
            $active_box_id = session('active_box_id');
            if(!isset($active_box_id)){
                $active_box = Box::create([
                   'user_id' => auth()->id()
                ]);
                $active_box_id = $active_box->id;
                session()->put('active_box_id', $active_box_id);
            }

            BoxProduct::updateOrCreate(
              ['box_id' => $active_box_id, 'product_id'=> $product->id],
              ['piece' => $cart_item->qty, 'price' => $product->price, 'status' => 'Pending']

            );
        }

        return redirect()->route('box')
            ->with('message_type', 'success')
            ->with('message', 'Product has been added to box.');
    }

    public function remove($row_id)
    {
        if(auth()->check()){
            $active_box_id = session('active_box_id');
            $cart_item = Cart::get($row_id);
            BoxProduct::where('box_id', $active_box_id)->where('product_id', $cart_item->id )->delete();
        }

        Cart::remove($row_id);

        return redirect()->route('box')
            ->with('message_type', 'success')
            ->with('message', 'Product has been removed from box.');
    }

    public function remove_box()
    {
        if(auth()->check()){
            $active_box_id = session('active_box_id');
            BoxProduct::where('box_id', $active_box_id)->delete();
        }

        Cart::destroy();
        return redirect()->route('box')
            ->with('message_type', 'success')
            ->with('message', 'Box has been removed.');
    }

    public function update($row_id)
    {

        $validator = Validator::make(request()->all(), [
            'piece' => 'required|numeric|between:0,5'
        ]);

        if($validator->fails()){
            session()->flash('message_type', 'danger');
            session()->flash('message', 'Piece value should be between 0 and 5.');
            return response()->json(['success'=>false]);
        }

        if(auth()->check()){
            $active_box_id = session('active_box_id');
            $cart_item = Cart::get($row_id);
            if(request('piece') == 0){
                BoxProduct::where('box_id', $active_box_id)->where('product_id', $cart_item->id)->delete();
            }else{
                BoxProduct::where('box_id', $active_box_id)->where('product_id', $cart_item->id)->update(['piece'=> request('piece')]);
            }
        }

        Cart::update($row_id, request('piece'));
        session()->flash('message_type', 'success');
        session()->flash('message', 'Piece information has been updated.');

        return response()->json(['success'=>true]);
    }
}
