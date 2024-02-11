@extends('layouts.admin')

@section('content')
    <h1>Role Details: {{ $role->name }}</h1>

    <p>ID: {{ $role->id }}</p>
    <p>Name: {{ $role->name }}</p>

    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>

    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
    </form>
    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
@endsection