@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add Roles to {{ $user->name }}</h1>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('user.assign-roles', $user) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="roles">Select Roles:</label>
            {{-- <select name="roles[]" id="roles" class="form-control" multiple>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select> --}}
            <div class="form-check">
                @foreach($roles as $role)
                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}"
                    @if($userRoles->contains($role->id)) checked @endif>
                <label class="form-check-label" for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label><br>
                @endforeach
            </div>
            @error('roles')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Assign Roles</button>
    </form>
</div>
@endsection
