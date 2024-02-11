@extends('layouts.admin')
 @section('title','Gestion des produits')
 @section('content')
     
 <h1>Recherche de produit</h1>

 <form action="{{ route('produits.index') }}" method="GET" class="row g-3">
  @csrf

  <div class="col-md-3">
      <label for="designation" class="form-label">Designation:</label>
      <input type="text" name="designation" id="designation" value="{{ old('designation', $designation) }}" class="form-control">
  </div>

  <div class="col-md-3">
      <label for="min_prix" class="form-label">min_prix:</label>
      <input type="text" name="min_prix" id="min_prix" value="{{ old('min_prix', $min_prix) }}" class="form-control">
  </div>

  <div class="col-md-3">
      <label for="max_prix" class="form-label">max_prix:</label>
      <input type="text" name="max_prix" id="max_prix" value="{{ old('max_prix', $max_prix) }}" class="form-control">
  </div>

  <div class="col-md-2 form-check">
      <input type="checkbox" id="quantite_null" name="quantite_null" value="quantite_null" {{ $quantite_null ? 'checked' : '' }} class="form-check-input">
      <label for="quantite_null" class="form-check-label"> produit hors stock</label>
  </div>

  <div class="col-md-1">
      <button type="submit" class="btn btn-primary">Rechercher</button>
  </div>
</form>

    <h1>Liste des produits</h1>
    <span>Resultat : {{$nbr_produits}}</span>
    <a href="{{route('produits.create')}}" class="btn btn-primary">Ajouter une nouvelle produit</a>
    <table id="tbl">
      <tr>
          <th>Id</th>
        <th>Designation</th>
        
        <th>prix_u</th>
        <th>quantite_stock</th>
        <th>categorie_id</th>
        <th colspan="3">Actions</th>
      </tr>
      @foreach ($produits as $pro)
          <tr>
            <td>{{$pro->id}}</td>
            <td>{{$pro->designation}}</td>
            <td>{{$pro->prix_u}}</td>
            <td>{{$pro->quantite_stock}}</td>
            <td>{{$pro->categorie_id}}</td>
            <td><a href="{{route('produits.show',['produit'=>$pro->id])}}" class="btn btn-info">Details</a></td>
            <td><a href="{{route('produits.edit',['produit'=>$pro->id])}}" class="btn btn-warning">Modifier</a></td>
            <td>
                <form action="{{route('produits.destroy',['produit'=>$pro->id])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Supprimer" onclick="return confirm('voulez-vous supprimer cette produit?')" class="btn btn-danger">
                </form></td>
          </tr>
      @endforeach
    </table>
    {{$produits->links()}}
 @endsection