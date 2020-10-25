@extends('admin.layouts.master')
@section('title', 'Category')
@section('content')
    <h1 class="page-header">Category Management</h1>

    <h2 class="sub-header"> Category List</h2>

    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.category.new_category') }}" class="btn btn-primary">Add New Category</a>
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        <form action="{{ route('admin.category') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" name="search" id="search"
                       placeholder="Search by Category Name" value="{{ old('search') }}">
                <label for="search_cat_id">Search Primary Category</label>
                <select name="search_cat_id" id="search_cat_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($primary_categories as $primary_category)
                        <option
                            value="{{ $primary_category->id }}" {{ old('search_cat_id') == $primary_category->id ? 'selected' : '' }}>{{ $primary_category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.category') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Category ID</th>
                <th>Category Slug</th>
                <th>Category Name</th>
                <th>Primary Category Name</th>
                <th>Register Date</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
            @if(count($category_list) == 0 )
                <tr>
                    <td colspan="6" class="text-center">
                        Not found record!
                    </td>
                </tr>
            @endif
            @foreach($category_list as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->slug }}</td>
                    <td>{{ $list->category_name }}</td>
                    <td>@if($list->cat_id)
                            <span class="label label-warning">{{ $list->primary_category->category_name }}</span>
                        @else
                            <span class="label label-success">This is already primary category.</span>
                        @endif

                    </td>

                    <td>{{ Carbon\Carbon::parse($list->created_at)->format('d/m/Y H:i:s')}}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.category.edit', $list->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.category.delete', $list->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $category_list->links() }}
    </div>
@endsection
