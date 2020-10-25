@extends('admin.layouts.master')
@section('title', 'Category')
@section('content')
    <h1 class="page-header">Category Management</h1>
    <h2 class="sub-header">Category Form</h2>
    <form action="{{ route('admin.category.save', @$list->id) }}" method="post">
        {{ csrf_field() }}


        <h2 class="sub-header">
            {{ @$list->id != null ? "Edit" : "Add" }} Category
        </h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_id">Primary Category Name</label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{ old('slug', $list->slug) }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                           value="{{ old('slug', $list->slug) }}">
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                           placeholder="Category Name"
                           value="{{ old('category_name', $list->category_name) }}">
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
