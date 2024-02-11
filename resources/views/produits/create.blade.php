@extends('layouts.admin')
 @section('title','Ajouter une produit')
 @section('content')
    <h1>Creer une nouvelle produit</h1>
    <form action="{{route('produits.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
        <label for="designation">Designation</label>
        <input type="text" name="designation" id="designation" value="{{old('designation')}}">
        </div>
        <div>
        <label for="prix_u">prix_u</label>
        <input type="text" name="prix_u" id="prix_u" value="{{old('prix_u')}}">
        </div>
        <div>
        <label for="quantite_stock">quantite_stock</label>
        <input type="text" name="quantite_stock" id="quantite_stock" value="{{old('quantite_stock')}}">
        </div>
        <div>
        <label for="categorie_id">Choose a categorie_id:</label>

        <select name="categorie_id" id="categorie_id">
        @foreach ($categories as $cat)
          <option value="{{$cat->id}}">{{$cat->id}}</option>
          @endforeach
        </select>
        </div>
        <div>
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo">
        </div>
         
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>
    <div>
        @if($errors->any())
        <ul>
          @foreach($errors->all() as $er)
           <li>{{$er}}</li>
           
           @endforeach
        </ul>
         


        @endif
    </div>
@endsection