@extends('layouts.client')
@section('title', 'Enregistrer infos client')
@section('content')
    <div class="container mt-3">
        <h1>Vos informations</h1>
        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}">
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}">
            </div>
            <div class="mb-3">
                <label for="tele" class="form-label">Tele</label>
                <input type="text" name="tele" id="tele" class="form-control" value="{{ old('tele') }}">
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Ajouter">
            </div>
        </form>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $er)
                        <li>{{ $er }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
