@extends('admin.layouts.master')
@section('title', 'Order')
@section('content')
    <h1 class="page-header">Order Management</h1>
    <h2 class="sub-header">Order Form</h2>
    <h2 class="sub-header">
        {{ @$list->id != null ? "Edit" : "Add" }} Order
    </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-6">
                <form action="{{ route('admin.order.save', @$list->id) }}" method="post">
                    {{ csrf_field() }}


                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')
                    <div class="row">
                        <br>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                       placeholder="Full Name"
                                       value="{{ old('full_name', $list->full_name) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="phone"></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Phone"
                                       value="{{ old('phone', $list->phone) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="cell_phone"></label>
                                <input type="text" class="form-control" id="cell_phone" name="cell_phone"
                                       placeholder="Cell Phone"
                                       value="{{ old('cell_phone', $list->cell_phone) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="address"></label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Address"
                                       value="{{ old('address', $list->address) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ old('status', $list->status) == 'Payment has been received.' ? 'selected' : '' }}>
                                        Payment has been received.
                                    </option>
                                    <option {{ old('status', $list->status) == 'Payment has been confirmed.' ? 'selected' : '' }}>
                                        Payment has been confirmed.
                                    </option>
                                    <option {{ old('status', $list->status) == 'It has been sent by cargo.' ? 'selected' : '' }}>
                                        It has been sent by cargo.
                                    </option>
                                    <option {{ old('status', $list->status) == 'Order has been completed.' ? 'selected' : '' }}>
                                        Order has been completed.
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pull-left">
                            <button type="submit" class="btn btn-primary">
                                {{ @$list->id != null ? "Edit" : "Save" }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <h2>Order (SP-{{$list->id}})</h2>
                <div class="row">
                    <div>
                        <table class="table table-bordererd table-hover">
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Price</th>
                                <th>Piece</th>
                                <th>Sub Total</th>
                                <th>Status</th>
                            </tr>
                            @foreach($list->box->box_products as $box_product)
                                <tr>
                                    <td><a href="{{ route('product', $box_product->product->slug) }}"><img src="{{ $box_product->product->detail->product_image!=null ? asset('uploads/products/' . $box_product->product->detail->product_image ) : '/img/400x400_product_image.png' }}" style="height: 100px; width: 100px;"></a></td>
                                    <td>
                                        <a href="{{ route('product', $box_product->product->slug) }}">{{ $box_product->product->product_name }}</a>
                                    </td>
                                    <td>{{ $box_product->price }} <small>₺</small></td>
                                    <td>{{ $box_product->piece }}</td>
                                    <td>{{ $box_product->price * $box_product->piece }} <small>₺</small></td>
                                    <td>{{ $box_product->status }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="4" class="text-right">Total Price</th>
                                <th colspan="2">{{ $list->order_price }} <small>₺</small></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">KDV</th>
                                <th colspan="2">{{ (($list->order_price * config('cart.tax')) / 100)}} <small>₺</small>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Total Price (KDV)</th>
                                <th colspan="2">{{ $list->order_price  * ((100+config('cart.tax'))/100) }}
                                    <small>₺</small></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Order Status</th>
                                <th colspan="2">{{ $list->status }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
