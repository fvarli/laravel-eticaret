@extends('admin.layouts.master')
@section('title', 'User')
@section('content')
    <h1 class="page-header">User Management</h1>

    <h1 class="sub-header">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.user.new_user') }}" class="btn btn-primary">Add New User</a>
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        User List
    </h1>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Active Status</th>
                <th>Admin Status</th>
                <th>Register Date</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
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
                    <td>{{ $list->created_at }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.user.edit', $list->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"
                           title="Edit">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.user.delete', $list->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                           title="Delete" onclick="return confirm('Are you sure?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
