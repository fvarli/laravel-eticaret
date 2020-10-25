@extends('admin.layouts.master')
@section('title', 'Product')
@section('content')
    <h1 class="page-header">Product Management</h1>

    <h2 class="sub-header"> Product List</h2>

    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.product.new_product') }}" class="btn btn-primary">Add New Product</a>
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        <form action="{{ route('admin.product') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" name="search" id="search"
                       placeholder="Search by ID, Name" value="{{ old('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.product') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Product ID</th>
                <th>Product Image</th>
                <th>Product Slug</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Register Date</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
            @if(count($product_list) == 0 )
                <tr>
                    <td colspan="7" class="text-center">
                        Not found record!
                    </td>
                </tr>
            @endif
            @foreach($product_list as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td><img src="{{ $list->detail->product_image!=null ? asset('uploads/products/' . $list->detail->product_image ) : '/img/400x400_product_image.png' }}" style="height: 100px; width: 100px;"></td>
                    <td>{{ $list->slug }}</td>
                    <td>{{ $list->product_name }}</td>
                    <td>{{ $list->price }} <small>₺</small></td>
                    <td>{{ Carbon\Carbon::parse($list->created_at)->format('d/m/Y H:i:s')}}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.product.edit', $list->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.product.delete', $list->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $product_list->links() }}
    </div>
@endsection
