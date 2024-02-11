@extends('layouts.client')
@section('title', 'Gestion des categories')
@section('content')

<div class="container mt-3">
    @if (empty($panier))
    <p class="lead">Votre panier est vide</p>
    @else
    <h1>Mon panier</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Designation</th>
                <th>Prix unitaire</th>
                <th>Quantite</th>
                <th>Total ligne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($panier as $id => $item)
            <tr>
                <td>{{ $id }}</td>
                <td>{{ $item['produit']->designation }}</td>
                <td>{{ $item['produit']->prix_u }}</td>
                <td>{{ $item['qte'] }}</td>
                <td>{{ $item['qte'] * $item['produit']->prix_u }} MAD</td>
                <td>
                    <form action="{{ route('home.delete', ['id' => $id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Voulez-vous supprimer cette ligne?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <th colspan="4">Total</th>
                <td colspan="2">{{ $tot }} MAD</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('home.clear') }}" class="btn btn-warning">Vider le panier</a>
    <a href="{{ route('clients.create') }}" class="btn btn-success">Commander</a>
    @endif
</div>

@endsection
