 @extends('layouts.admin')
 @section('title','Gestion des categories')
 @section('content')
     
    <h1>Liste des categories</h1>
    <div class="catalogue">
   
   @foreach ($produits as $item)
       <div class="item">
        <p>{{$item->designation}}</p>
        <p>Prix : {{$item->prix_u}} MAD</p>
        @if ($item->quantite_stock==0)
            <p>En repture de stock</p>
        @else
        <p>En stock : {{$item->quantite_stock}}</p>
        <form action="{{route('home.add',["id"=>$item->id])}}" method='POST'>
            @csrf
            <label for="qte">Quantite</label>
            <input type="number" name="qte" id="qte" min="1" max="{{$item->quantite_stock}}">
            <input type="submit" value="Acheter">
        </form>
          @endif
       </div>
 
   @endforeach
     
    </div>

@endsection