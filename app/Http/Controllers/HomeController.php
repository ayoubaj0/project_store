<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $produits=Produit::all([ 'id','designation','prix_u','quantite_stock',]);
        return view('home.index',compact('produits'));
    }
    public function add(Request $request,$id){
        $qte=$request->input('qte',1);
         $produit=Produit::find($id);
        $panier=$request->session()->get('panier',[]);
        if(isset($panier[$id])){
            $panier[$id]['qte']=$qte;
        }else{
        $panier[$id]=[
            'qte'=>$qte,
             'produit'=>$produit
        ];
    }
    
    $request->session()->put('panier',$panier);
    return redirect()->back();
        
    }
    public function show_panier(Request $request){
        $panier=$request->session()->get('panier',[]);
        $tot=0;
        foreach($panier as $id=>$item){
            $tot+=$item['qte']*$item['produit']->prix_u;
        }
        return view('home.panier',compact('panier','tot'));
    }
    public function delete(Request $request,$id){
        $panier=$request->session()->get('panier',[]);
        unset($panier[$id]);
        $request->session()->put('panier',$panier);
        return redirect()->back();
    }
    public function clear(Request $request ){

        $request->session()->forget('panier');
        // return redirect()->back();
        return redirect()->route('home.index');

    }
   
    
}