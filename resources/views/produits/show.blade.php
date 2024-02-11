@extends('layouts.admin')
 @section('title','Detail d \'une produit')
 @section('content')
    <a href="{{route('produits.index')}}">Retourner vers la liste des produits</a>
    <h1>Detail de la produit Num {{$pro->id}}</h1>
    <div>
        <p><strong>Designation:</strong> {{$pro->designation}}</p>
        <p><strong>prix_u:</strong> {{$pro->prix_u}}</p>
        <p><strong>quantite_stock:</strong> {{$pro->quantite_stock}}</p>
        <p><strong>categorie_id:</strong> {{$pro->categorie_id}}</p>
    </div>
    @if ($pro->photo)
        <img src="{{ asset('storage/' . $pro->photo) }}" alt="Product Photo" style="max-width: 300px; max-height: 300px;">
    @else
        <p>No photo available</p>
    @endif
@endsection