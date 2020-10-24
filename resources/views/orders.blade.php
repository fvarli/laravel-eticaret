@extends('layouts.master')
@section('title', 'Orders')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Orders</h2>
            @if(count($product_orders) ==0)
                <p>There is no order yet.</p>
            @else
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th>Order Code</th>
                        <th>Price</th>
                        <th>Total Piece</th>
                        <th>Status</th>
                        <th>Process</th>
                    </tr>
                    @foreach($product_orders as $p_order)
                        <tr>
                            <td>SP-{{ $p_order->id }}</td>
                            <td>{{ $p_order->order_price * ((100+config('cart.tax'))/100) }}</td>
                            <td>{{ $p_order->box->box_product_piece() }}</td>
                            <td>{{ $p_order->status }}</td>
                            <td>
                                <a href="{{ route('order', $p_order->id ) }}" class="btn btn-sm btn-success">Detay</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection()
<?php
?>
