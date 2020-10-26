@extends('admin.layouts.master')
@section('title', 'Order')
@section('content')
    <h1 class="page-header">Order Management</h1>
    <h2 class="sub-header">Order Form</h2>
    <form action="{{ route('admin.product.save', @$list->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}


        <h2 class="sub-header">
            {{ @$list->id != null ? "Edit" : "Add" }} Product
        </h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')
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
                    <label for="category_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                           placeholder="Product Name"
                           value="{{ old('product_name', $list->product_name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                           placeholder="Price"
                           value="{{ old('price', $list->price) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="show_slider" value="0">
                        <input type="checkbox" name="show_slider"
                               value="1" {{ old('show_slider', $list->detail->show_slider) ? 'checked' : '' }}> Show on
                        Slider
                    </label> |
                    <label>
                        <input type="hidden" name="show_today_opportunity" value="0">
                        <input type="checkbox" name="show_today_opportunity"
                               value="1" {{ old('show_today_opportunity', $list->detail->show_today_opportunity) ? 'checked' : '' }}>
                        Show Today Opportunity
                    </label> |
                    <label>
                        <input type="hidden" name="show_featured" value="0">
                        <input type="checkbox" name="show_featured"
                               value="1" {{ old('show_featured', $list->detail->show_featured) ? 'checked' : '' }}> Show
                        Featured
                    </label> |
                    <label>
                        <input type="hidden" name="show_best_seller" value="0">
                        <input type="checkbox" name="show_best_seller"
                               value="1" {{ old('show_best_seller', $list->detail->show_best_seller) ? 'checked' : '' }}>
                        Show Best Seller
                    </label> |
                    <label>
                        <input type="hidden" name="show_discount" value="0">
                        <input type="checkbox" name="show_discount"
                               value="1" {{ old('show_discount', $list->detail->show_discount) ? 'checked' : '' }}> Show
                        Discount
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ collect(old('categories', $product_categories))->contains($category->id) ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $list->description) }}
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @if($list->detail->product_image !=null)
                        <img src="/uploads/products/{{ $list->detail->product_image }}" alt="" style="height: 100px; margin-right: 20px" class="thumbnail pull-left">
                    @endif
                    <label for="product_image">Product Image</label>
                    <input type="file" id="product_image" name="product_image">
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

@endsection
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
        $(function () {
            $('#categories').select2({
                placeholder: 'Please select a category'
            });
            let options = {
                language: 'en',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('description', options);
        });
    </script>
@endsection
