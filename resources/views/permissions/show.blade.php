@extends('layouts.admin')

@section('content')
    <h1>Permission Details: {{ $permission->name }}</h1>

    <p>ID: {{ $permission->id }}</p>
    <p>Name: {{ $permission->name }}</p>

    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>

    <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
    </form>
    <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back to Permissions</a>
@endsection
