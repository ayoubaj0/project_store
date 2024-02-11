
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Assign Roles to User</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('users.assign-roles', $user) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="roles">Select Roles:</label>
                        <select name="roles[]" id="roles" class="form-control" multiple>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Assign Roles</button>
                </form>
            </div>
        </div>
    </div>
@endsection
