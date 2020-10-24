@extends('admin.layouts.master')
@section('title', 'User')
@section('content')
    <h1 class="page-header">User Management</h1>
    <h1 class="sub-header">User Form</h1>
    <form action="{{ route('admin.user.save', @$list->id) }}" method="post">
        {{ csrf_field() }}


        <h2 class="sub-header">
            {{ @$list->id != null ? "Edit" : "Add" }} User
        </h2>
        <div class="row">
            @include('layouts.partials.errors')
            @include('layouts.partials.alert')
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name"
                           value="{{ old('full_name', $list->full_name) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $list->email) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                           value="{{ old('address', $list->user_detail->address) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                           value="{{ old('phone', $list->user_detail->phone) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cell_phone">Cell Phone</label>
                    <input type="text" class="form-control" id="cell_phone" name="cell_phone" placeholder="Cell Phone"
                           value="{{ old('cell_phone', $list->user_detail->cell_phone) }}">
                </div>
            </div>
            <div class="col-md-1">
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $list->is_active) ? 'checked' : '' }}> Is
                        Active?
                    </label>
                </div>
            </div>
            <div class="col-md-1">
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $list->is_admin) ? 'checked' : '' }}> Is
                        Admin?
                    </label>
                </div>
            </div>

        </div>

        <div class="pull-left">
            <button type="submit" class="btn btn-primary">
                {{ @$list->id != null ? "Edit" : "Save" }}
            </button>
        </div>
        </div>
    </form>
@endsection
