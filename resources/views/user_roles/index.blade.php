@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('user.show-roles', $user) }}" class="btn btn-primary">Edite Role user</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
