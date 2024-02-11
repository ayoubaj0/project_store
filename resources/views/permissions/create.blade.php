@extends('layouts.admin')

@section('content')
    <h1>Create New Permission</h1>

    <form method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <label for="name">Permission Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Create Permission</button>
    </form>
@endsection
