@extends('layouts.admin')

@section('content')
    <h1>Edit Role: {{ $role->name }}</h1>

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Role Name:</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" required>
        <button type="submit">Update Role</button>
    </form>
@endsection