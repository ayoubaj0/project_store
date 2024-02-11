@extends('layouts.admin')

@section('content')
    <h1>Create New Role</h1>

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <label for="name">Role Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create Role</button>
    </form>
@endsection
