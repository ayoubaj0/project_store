<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$produits=Produit::all();
        //$produits=Produit::paginate(10);
        //$designation = $request->input('designation');
        //$designation = $request->query('designation');
        //$produits = Produit::where('designation', 'like','%' . $designation . '%')->get();
       
        $designation = $request->query('designation');
        $min_prix = $request->query('min_prix');
        $max_prix = $request->query('max_prix');
        $quantite_null = $request->query('quantite_null');
        
        $query = Produit::query();
        if ($designation) {
            $query->where('designation', 'like', '%' . $designation . '%');
        }
    
        if ($min_prix) {
            $query->where('prix_u', '>=', $min_prix);
        }
        if ($max_prix) {
            $query->where('prix_u', '<=', $max_prix);
        }
        if ($quantite_null) {
            $query->where('quantite_stock', '=', 0);
        }
        $nbr_produits = count($query->get());
        $produits = $query->paginate(10);
        
       
         return view("produits.index",compact('produits','designation','min_prix','max_prix','quantite_null','nbr_produits'));
       
       
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Categorie::all();
        return view('produits.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $request->file('photo')->store('produit','public');
        $data = $request->validate([
            'designation'=>'required|unique:produits,designation',
            'prix_u'=>'required|integer|between:0,99999',
            'quantite_stock'=>'required|integer|between:1,9999',
            'photo'=>'required|image|mimes:png,jpg,svg,jpeg|max:40000',
            'categorie_id'=>'required'
        ]);
        if ($request->hasFile('photo')){
          $data['photo'] = $request->file('photo')->store('produit','public');
            
        }
        
       Produit::create($data); 
        return  redirect()->route('produits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pro=Produit::find($id);
        
        return view('produits.show')->with("pro",$pro);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories=Categorie::all();
        $pro=Produit::find($id);
        return view('produits.edit',compact('pro','categories'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =$request->validate([
            'designation'=>'required|unique:produits,designation',
            'prix_u'=>'required|integer|between:0,99999',
            'quantite_stock'=>'required|integer|between:0,9999',
            'photo'=>'required|image|mimes:png,jpg,svg,jpeg|max:40000',
            'categorie_id'=>'required'
       ]);
       if ($request->hasFile('photo')){
        $data['photo'] = $request->file('photo')->store('produit','public');
          
      }
        $pro=Produit::find($id);
        //$pro->update($request->all());
        $pro->update($data);
        return redirect()->route('produits.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produit::destroy($id);
        return  redirect()->route('produits.index');

        //
    }
    public function indexp()
    {
        $produits=Produit::all();
       
        return view("welcome",compact('produits'));
    }
}
