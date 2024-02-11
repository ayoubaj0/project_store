@extends('layouts.admin')

@section('content')
    <h1>Roles List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('roles.assign-permissions', $role->id) }}" class="btn btn-warning">Edit role</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('roles.create') }}" class="btn btn-success">Create New Role</a>
@endsection
