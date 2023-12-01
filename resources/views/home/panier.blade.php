 @extends('layouts.admin')
 @section('title','Gestion des categories')
 @section('content')

@if (empty($panier))
    <p>Votre panier est vide</p>
@else
    <h1>Mon panier</h1>

  <table id="tbl">
      <tr>
          <th>Id</th>
        <th>Designation</th>
        <th>Prix unitaire</th>
        <th>Quantite</th>
        <th>Total ligne</th>
        <th>Actions</th>
      </tr>
      @foreach ($panier as $id=> $item)
          <tr>
            <td>{{$id}}</td>
            <td>{{$item['produit']->designation}}</td>
            <td>{{$item['produit']->prix_u}}</td>
            <td>{{$item['qte']}}</td>
            <td>{{$item['qte']*$item['produit']->prix_u}} MAD</td>
            <td>
                <form action="{{route('home.delete',["id"=>$id])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Supprimer" onclick="return confirm('voulez-vous supprimer cette ligne?')">
                </form></td>
          </tr>
      @endforeach
      <tr>
        <th colspan="4">Total</th>
        <td colspan="2">{{$tot}} MAD</td>
     </tr>
    </table>
  <a href="{{route('home.clear')}}">Vider le panier</a>
  @endif
@endsection