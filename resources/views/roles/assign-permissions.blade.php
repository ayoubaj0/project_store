<!-- resources/views/roles/assign-permissions.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Affecter des permissions au rôle {{ $role->name }}</div>
            <div class="card-body">
                <form action="{{ route('roles.assign-permissions', $role->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Permissions disponibles</h5>
                            <ul>
                                @foreach ($permissions as $permission)
                                    @if (!$role->hasPermissionTo($permission))
                                        <li>
                                            <label>
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Permissions assignées</h5>
                            <ul>
                                @foreach ($permissions as $permission)
                                    @if ($role->hasPermissionTo($permission))
                                        <li>
                                            <label>
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}" checked>
                                                {{ $permission->name }}
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
