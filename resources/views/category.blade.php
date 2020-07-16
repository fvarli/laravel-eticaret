@extends('layouts.master')
@section('title', 'Category | '. $category->category_name)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="#">{{ $category->category_name }}</a></li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $category->category_name }}</div>
                    <div class="panel-body">
                        @if(count($sub_category) > 0)
                            <h3>Alt Kategoriler</h3>
                                <div class="list-group categories">
                                    @foreach($sub_category as $sub_cat)
                                        <a href="{{route('category', $sub_cat->slug)}}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i> {{$sub_cat->category_name}}</a>
                                    @endforeach
                                </div>
                            <h3>Fiyat Aralığı</h3>
                            <form>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 100-200
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 200-300
                                        </label>
                                    </div>
                                </div>
                            </form>
                        @else
                            In this category, there is no sub category.
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($products) > 0 )
                        Order
                        <a href="?order=bestseller" class="btn btn-default">Best Seller</a>
                        <a href="?order=new" class="btn btn-default">New Prodcuts</a>
                    @endif
                    <hr>
                    <div class="row">
                        @if(count($products) == 0)
                            <div class="col-lg-12">
                                There is no any product here for now.
                            </div>
                        @endif
                        @foreach($products as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product', $product->slug)}}"><img src="/img/400x400_product_image.png"></a>
                                <p><a href="{{route('product', $product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}} ₺</p>
                                <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                            </div>
                        @endforeach
                    </div>
                    {{ request()->has('order') ? $products->appends(['order' => request('order')])->links() : $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
?>
