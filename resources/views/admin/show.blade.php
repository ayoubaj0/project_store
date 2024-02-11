@extends('layouts.admin')
@section('title', 'Détail d\'une commande')
@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-primary">Retourner vers la liste des commandes</a>
    <h1>Détail de la commande Num {{ $commande->id }}</h1>

    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Informations sur la commande</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Id de la commande</th>
                        <td>{{ $commande->id }}</td>
                    </tr>
                    <tr>
                        <th>Date/Heure</th>
                        <td>{{ $commande->date }}</td>
                    </tr>
                    <tr>
                        <th>Prix Total</th>
                        <td>{{ $commande->total_prix }} MAD</td>
                    </tr>
                    <tr>
                        <th>Client</th>
                        <td>{{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                    </tr>
                    <tr>
                        <th>Ville</th>
                        <td>Agadir</td>
                    </tr>
                    <tr>
                        <th>Téléphone</th>
                        <td>{{ $commande->client->tele }}</td>
                    </tr>
                    <tr>
                        <th>État</th>
                        <td>{{ $commande->etat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h3>Produits commandés</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Produit</th>
                        <th>Désignation</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->ligneDeCommande as $item)
                        <tr>
                            <td>{{ $item->produit_id }}</td>
                            <td>{{ $item->produit->designation }}</td>
                            <td>{{ $item->prix }} MAD</td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ $item->prix * $item->quantite }} MAD</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Changer l'état de la commande</h3>
            <form action="{{ route('admin.changeEtat') }}" method="POST"
                onsubmit="return confirm('Êtes-vous sûr de vouloir changer l\'état?')">
                @csrf
                @method('PUT')

                <select id="etat" name="etat" class="form-select">
                    <option value="" disabled selected>Sélectionnez l'état</option>
                    <option value="En_attente_de_confirmation">En attente de confirmation</option>
                    <option value="confirmee">Confirmée</option>
                    <option value="envoyee">Envoyée</option>
                    <option value="payee">Payée</option>
                    <option value="retournee">Retournée</option>
                </select>
                <input type="hidden" name="command_id" value="{{ $commande->id }}">
                <button type="submit" class="btn btn-success">Valider les changements</button>
            </form>
        </div>
    </div>
    
    <style>
        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
        }

        .invoice-details {
            margin-top: 20px;
        }

        .invoice-products {
            margin-top: 30px;
        }

        .invoice-products table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .invoice-products th, .invoice-products td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-footer {
            margin-top: 20px;
            text-align: center;
        }
        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

    </style>

    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Facture</h2>
        </div>

        <div class="invoice-details">
            <h3>Informations sur la commande</h3>
            <table>
                <tr>
                    <th>Id de la commande </th>
                    <td> <strong> : </strong> {{ $commande->id }}</td>
                </tr>
                <tr>
                    <th>Date/Heure de commande </th>
                    <td> <strong> : </strong> {{ $commande->date }}</td>
                </tr>
                <tr>
                    <th>Client  </th>
                    <td> <strong> : </strong>  {{ $commande->client->prenom }} {{ $commande->client->nom }}</td>
                </tr>
                <tr>
                    <th>Ville de client  </th>
                    <td> <strong> : </strong> Agadir</td>
                </tr>
                <tr>
                    <th>Téléphone de client : </th>
                    <td> <strong> : </strong> {{ $commande->client->tele }}</td>
                </tr>

            </table>
        </div>

        <div class="invoice-products">
            <h3>Produits commandés</h3>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID Produit</th>
                        <th>Désignation</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->ligneDeCommande as $item)
                        <tr>
                            <td>{{ $item->produit_id }}</td>
                            <td>{{ $item->produit->designation }}</td>
                            <td>{{ $item->prix }} MAD</td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ $item->prix * $item->quantite }} MAD</td>
                            
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-center bg-secondary">Prix Total</th>
                        <td colspan="1" >{{ $commande->total_prix }} MAD</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-footer">
            <p>Merci de faire affaire avec nous!</p>
        </div>
    </div>

    

@endsection
