@extends('layouts.master')
@section('title', 'Box')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Box</h2>

            @include('layouts.partials.alert')
            <br>
            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Product</th>
                        <th>Unit Price</th>
                        <th>Piece</th>
                        <th>Price</th>

                    </tr>

                    @foreach(Cart::content() as $product_cart_item)
                        <tr>
                            <td style="width: 120px; height: 120px;"><a
                                    href="{{ route('product', $product_cart_item->options->slug) }}"><img
                                        src="/img/640x400_product_image.png"
                                        style="width: 120px; height: 120px;"></a></td>
                            <td>
                                <a href="{{ route('product', $product_cart_item->options->slug) }}">{{ $product_cart_item->name }}
                                </a>
                                <form action="{{ route('box.remove', $product_cart_item->rowId) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-xs" value="Remove from Box">
                                </form>
                            </td>
                            <td>{{ $product_cart_item->price }} ₺</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-default decrease-product-piece" data-id="{{ $product_cart_item->rowId }}" data-piece="{{ $product_cart_item->qty - 1 }}">-</a>
                                <span style="padding: 10px 20px">{{ $product_cart_item->qty }}</span>
                                <a href="#" class="btn btn-xs btn-default increase-product-piece" data-id="{{ $product_cart_item->rowId }}" data-piece="{{ $product_cart_item->qty + 1 }}">+</a>
                            </td>
                            <td class="text-right">
                                {{ $product_cart_item->subtotal }} ₺
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Sub Total</th>
                        <th>{{ Cart::subtotal() }} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">KDV</th>
                        <th>{{ Cart::tax() }} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Total</th>
                        <th>{{ Cart::total() }} ₺</th>
                    </tr>
                </table>
                <form action="{{ route('box.remove_box') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-info pull-left" value="Remove Box">
                </form>
                <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            @else
                There is no any product yet.
            @endif
        </div>
    </div>
@endsection
<?php
?>
