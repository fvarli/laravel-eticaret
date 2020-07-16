@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="active">Search Result</li>
        </ol>

        <div class="products bg-content">
            <div class="row">
                @if(count($products) == 0)
                    <div class="col-md-12 text-center">
                        No product found.
                    </div>
                @endif
                @foreach($products as $product)
                    <div class="col-md-3 product">
                        <a href="{{ route('product', $product->slug) }}">
                            <img src="/img/640x400_product_image.png" alt="{{ $product->product_name }}">
                        </a>
                        <p>
                            <a href="{{route('product', $product->slug)}}">
                                {{$product->product_name}}
                            </a>
                        </p>
                        <p class="price">{{ $product->price }} ₺</p>
                    </div>
                @endforeach
            </div>
            {{$products->appends(['search_product' => old('search_product')])->links()}}
        </div>

    </div>
@endsection
