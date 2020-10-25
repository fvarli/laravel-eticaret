@extends('layouts.master')
@section('title', 'Home')
@section('content')
    @include('layouts.partials.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>
                    <div class="list-group categories">
                        @foreach($categories as $cat)
                            <a href="{{route('category',$cat->slug)}}" class="list-group-item"><i class="fa fa-arrow-circle-o-right"></i> {{ $cat->category_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0; $i<count($products_slider); $i++)
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="{{ $i == 0 ? 'active': '' }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($products_slider as $index => $product)
                            <div class="item {{ $index == 0 ? 'active': '' }}">
                                <img src="/img/640x400_product_image.png" alt="...">
                                <div class="carousel-caption">
                                    {{ $product->product_name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <a href="{{ route('product', $show_today_opportunity->slug) }}" style="color: blue">
                            <img src="{{ $show_today_opportunity->detail->product_image!=null ? asset('uploads/products/' . $show_today_opportunity->detail->product_image ) : '/img/400x400_product_image.png' }}" class="img-responsive" style="min-width: 100%">
                            {{ $show_today_opportunity->product_name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($products_featured as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{ $product->detail->product_image!=null ? asset('uploads/products/' . $product->detail->product_image ) : '/img/400x400_product_image.png' }}" class="img-responsive" style="min-width: 100%"></a>
                                <p><a href="{{ route('product', $product->slug) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </p>
                                <p class="price">{{ $product->price }} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($products_best_seller as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{ $product->detail->product_image!=null ? asset('uploads/products/' . $product->detail->product_image ) : '/img/400x400_product_image.png' }}" class="img-responsive" style="min-width: 100%"></a>
                                <p><a href="{{ route('product', $product->slug) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </p>
                                <p class="price">{{ $product->price }} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($products_discount as $product)
                            <div class="col-md-3 product">
                                <a href="{{ route('product', $product->slug) }}">
                                    <img src="{{ $product->detail->product_image!=null ? asset('uploads/products/' . $product->detail->product_image ) : '/img/400x400_product_image.png' }}" class="img-responsive" style="min-width: 100%"></a>
                                <p><a href="{{ route('product', $product->slug) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </p>
                                <p class="price">{{ $product->price }} ₺</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
?>
