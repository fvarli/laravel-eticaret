@extends('admin.layouts.master')
@section('title', 'Order')
@section('content')
    <h1 class="page-header">Order Management</h1>

    <h2 class="sub-header"> Order List</h2>

    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        <form action="{{ route('admin.order') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" name="search" id="search"
                       placeholder="Search Order" value="{{ old('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.order') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Order Code</th>
                <th>User Name</th>
                <th>Bank</th>
                <th>Order Price</th>
                <th>Order Status</th>
                <th>Register Date</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
            @if(count($order_list) == 0 )
                <tr>
                    <td colspan="7" class="text-center">
                        Not found record!
                    </td>
                </tr>
            @endif
            @foreach($order_list as $list)
                <tr>
                    <td>SP-{{ $list->id }}</td>
                    <td>{{ $list->box->user->full_name }}</td>
                    <td>{{ $list->bank }}</td>
                    <td>{{ $list->order_price * ((100 + config('cart.tax'))/100) }} <small>₺</small></td>
                    <td>{{ $list->status }}</td>
                    <td>{{ Carbon\Carbon::parse($list->created_at)->format('d/m/Y H:i:s')}}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.order.edit', $list->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.order.delete', $list->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $order_list->links() }}
    </div>
@endsection
