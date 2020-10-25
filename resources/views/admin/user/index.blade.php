@extends('admin.layouts.master')
@section('title', 'User')
@section('content')
    <h1 class="page-header">User Management</h1>

    <h2 class="sub-header"> User List</h2>

    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.user.new_user') }}" class="btn btn-primary">Add New User</a>
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        <form action="{{ route('admin.user') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control form-control-sm" name="search" id="search" placeholder="Search by ID, Name, Email" value="{{ old('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.user') }}" class="btn btn-primary">Clear</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Admin Status</th>
                <th>Active Status</th>
                <th>Register Date</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
            @if(count($user_list) == 0 )
                <tr>
                    <td colspan="7" class="text-center">
                        Not found record!
                    </td>
                </tr>
            @endif
            @foreach($user_list as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->full_name }}</td>
                    <td>{{ $list->email }}</td>
                    <td>
                        @if($list->is_admin)
                            <span class="label label-success">Admin</span>
                        @else
                            <span class="label label-warning">Client</span>
                        @endif
                    </td>
                    <td>
                        @if($list->is_active)
                            <span class="label label-success">Active</span>
                        @else
                            <span class="label label-warning">Not Active</span>
                        @endif
                    </td>
                    <td>{{ Carbon\Carbon::parse($list->created_at)->format('d/m/Y H:i:s')}}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.user.edit', $list->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.user.delete', $list->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $user_list->links() }}
    </div>
@endsection
