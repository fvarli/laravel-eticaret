@extends('layouts.master')
@section('title', 'Order Detail')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{ route('orders') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-arrow-left"> Back to Orders</i></a>
            <h2>Sipariş (SP-{{$order_detail->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Price</th>
                    <th>Piece</th>
                    <th>Sub Total</th>
                    <th>Status</th>
                </tr>
                @foreach($order_detail->box->box_products as $box_product)
                <tr>
                    <td><a href="{{ route('product', $box_product->product->slug) }}"><img src="{{ $box_product->product->detail->product_image!=null ? asset('uploads/products/' . $box_product->product->detail->product_image ) : '/img/400x400_product_image.png' }}" style="height: 100px; width: 100px;"></a></td>
                    <td><a href="{{ route('product', $box_product->product->slug) }}">{{ $box_product->product->product_name }}</a></td>
                    <td>{{ $box_product->price }} <small>₺</small></td>
                    <td>{{ $box_product->piece }}</td>
                    <td>{{ $box_product->price * $box_product->piece }} <small>₺</small></td>
                    <td>{{ $box_product->status }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Total Price</th>
                    <th colspan="2">{{ $order_detail->order_price }} <small>₺</small></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV</th>
                    <th colspan="2">{{ (($order_detail->order_price * config('cart.tax')) / 100)}} <small>₺</small></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total Price (KDV)</th>
                    <th colspan="2">{{ $order_detail->order_price  * ((100+config('cart.tax'))/100) }} <small>₺</small></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Order Status</th>
                    <th colspan="2">{{ $order_detail->status }}</th>
                </tr>
            </table>
        </div>
    </div>
@endsection()
<?php
?>
