@extends('admin.layout.master')
@section('content')
    <h1 class="page-header">User Management</h1>
    <h3 class="sub-header"> User List </h3>
    <div class="well">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <a href="{{ route('admin.user-create') }}" class="btn btn-primary">Add User</a>
        </div>
        <form action="{{ route('admin.users') }}" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="search_key">Search</label>
                <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Type Name, Email..."
                value="{{ old('search_key') }}"
                >
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.users') }}" class="btn btn-danger" >Clear</a>
        </form>
    </div>
    @include('layout.partials.alert')
    @include('layout.partials.error')
    <div class="table-responsive">
        @if (count($users) > 0)
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Is Active</th>
                    <th>Is Admin</th>
                    <th>Register Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td> {{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="color:#fff; background:{{ $user->isActive ? 'green' : 'red' }}">{{ $user->isActive ? 'Active' : 'Passive'  }}</td>
                        <td style="background:{{ $user->isAdmin ? '#004684; color:#fff' : '#ffef03' }}">{{ $user->isAdmin ? 'Admin' : 'User'  }}</td>
                        <td> {{ $user->created_at .' ('. timeConvert($user->created_at) .')' }}</td>
                        <td style="width: 100px">
                            <a href="{{ route('admin.user-update', $user->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Update">
                                <span class="fa fa-pencil"></span>
                            </a>
                            <a href="{{ route('admin.user-delete', $user->id) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')">
                                <span class="fa fa-trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="alert alert-warning">
                There is nothing...
            </div>
        @endif
        {{ $users->links() }}
    </div>
@endsection