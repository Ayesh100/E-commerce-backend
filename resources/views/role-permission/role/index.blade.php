@extends('layouts.master.body')

@section('main-content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex flex-column align-items-center mb-3">
                <div class="container mt-5">
                    <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
                    @role('super-admin')
                    <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
                @endrole
                    <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
                </div>

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-12">

                            @if (session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4>
                                        Roles
                                        @can('create role')
                                            <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                                        @endcan
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th width="40%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                @if (auth()->user()->hasRole('super-admin') || $role->name !== 'super-admin')
                                                    <tr>
                                                        <td>{{ $role->id }}</td>
                                                        <td>{{ $role->name }}</td>
                                                        <td>
                                                            <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                                class="btn btn-warning">
                                                                Add / Edit Role Permission
                                                            </a>

                                                            @can('update role')
                                                                <a href="{{ url('roles/' . $role->id . '/edit') }}"
                                                                    class="btn btn-success">
                                                                    Edit
                                                                </a>
                                                            @endcan

                                                            @can('delete role')
                                                                <form action="{{ route('roles.destroy', $role->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger mx-1"
                                                                        onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
