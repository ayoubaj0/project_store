@extends('layouts.client')
@section('title', 'Gestion des categories')
@section('content')

<div class="container mt-3">
    <h1>Liste des categories</h1>
    <div class="row">
        @foreach ($produits as $item)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->designation }}</h5>
                    <p class="card-text">Prix : {{ $item->prix_u }} MAD</p>
                    @if ($item->quantite_stock == 0)
                    <p class="card-text text-danger">En rupture de stock</p>
                    @else
                    <p class="card-text">En stock : {{ $item->quantite_stock }}</p>
                    <form action="{{ route('home.add', ["id" => $item->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="qte" class="form-label">Quantite</label>
                            <input type="number" name="qte" id="qte" class="form-control" min="1"
                                max="{{ $item->quantite_stock }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Acheter</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
