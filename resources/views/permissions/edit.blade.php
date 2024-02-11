@extends('layouts.admin')

@section('content')
    <h1>Edit Permission: {{ $permission->name }}</h1>

    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Permission Name:</label>
        <input type="text" name="name" id="name" value="{{ $permission->name }}" required>
        <button type="submit">Update Permission</button>
    </form>
@endsection
