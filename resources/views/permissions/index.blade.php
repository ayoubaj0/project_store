@extends('layouts.admin')

@section('content')
    <h1>Permissions List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('permissions.create') }}" class="btn btn-success">Create New Permission</a>
@endsection
