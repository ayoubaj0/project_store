<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Commande;
use App\Models\LigneDeCommande;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth')->except(['store']);
    }
    public function index(Request $request){
         
        $etat = $request->query('etat');
        $nom = $request->query('nom');
        $date = $request->query('date');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        $query = DB::table('commandes')
           ->join('clients','commandes.client_id','=','clients.id')
           ->leftJoin('ligne_de_commande', 'commandes.id', '=', 'ligne_de_commande.commande_id')
           ->select('commandes.*','clients.*',
                DB::raw('SUM(ligne_de_commande.prix * ligne_de_commande.quantite) as total_prix'))
           ->groupBy('commandes.id', 'commandes.date', 'commandes.client_id',
                'commandes.etat',
                'commandes.created_at',
                'commandes.updated_at',
                'clients.id',
                'clients.nom',
                'clients.prenom',
                'clients.tele',
                'clients.created_at',
                'clients.updated_at');
        //$lignecmd=LigneDeCommande::all();
        if ($etat) {
            $query->where('commandes.etat', '=', $etat);
        }
    
        if ($nom) {
            $query->where('clients.nom', 'like', '%' . $nom . '%');
        }

        if ($startDate && $endDate) {
            $query->whereBetween('commandes.date', [$startDate, $endDate]);
        }
    
        $commandes = $query->get();
        
        return view('admin.index',compact('commandes'));
    
         }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $v=$request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'tele'=>'required'
            
        ]);
        $client=Client::create($v);
        $cmd=Commande::create(['date'=>now(),'client_id'=>$client->id]);
        $panier=$request->session()->get('panier');
        foreach($panier as $id=>$item){
            LigneDeCommande::create([
                'produit_id'=>$item['produit']->id,
                'commande_id'=>$cmd->id,
                'quantite'=>$item['qte'],
                'prix'=>$item['produit']->prix_u,
            ]);
            $produit=Produit::find($item['produit']->id);
            $produit->quantite_stock-=$item['qte'];
            $produit->save();
        }
        return view('commandes.succes');


    }
    // public function changeEtat(Request $request)
    // {
    //     //dd($request->all());
    //     $request->validate([
    //         'command_id' => 'required',
    //         'etat' => 'required|in:En_attente_de_confirmation,confirmee,envoyee,payee,retournee',
    //     ]);

       
    //     $commandId = $request->input('command_id');
    //     $newEtat = $request->input('etat');

    //     // Update the 'etat' field in the database
    //     Commande::where('id', $commandId)->update(['etat' => $newEtat]);

    //     // Redirect back to the index page or wherever you want
    //     return redirect()->route('admin.index');
    // }
    public function changeEtat(Request $request)
{
    // dd($request->all());
    $request->validate([
        'command_id' => 'required',
        'etat' => 'required|in:En_attente_de_confirmation,confirmee,envoyee,payee,retournee',
    ]);

    $commandId = $request->input('command_id');
    $newEtat = $request->input('etat');
    $currentEtat = Commande::where('id', $commandId)->value('etat');

    $validTransitions = [
        'En_attente_de_confirmation' => ['confirmee'],
        'confirmee' => ['envoyee'],
        'envoyee' => ['payee'],
        'payee' => ['retournee'],
    ];

    if (!in_array($newEtat, $validTransitions[$currentEtat])) {
        return redirect()->back();
        // return redirect()->back()->withErrors(['etat' => 'Invalid state transition.']);
    }
    Commande::where('id', $commandId)->update(['etat' => $newEtat]);
    return redirect()->route('admin.index');
}

    public function exportCSV()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=commands.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $commands = DB::table('commandes')
            ->join('clients', 'commandes.client_id', '=', 'clients.id')
            ->select('commandes.*', 'clients.nom', 'clients.prenom', 'clients.tele')
            ->get();

        $columns = array('ID','Date','Prix Total','Client ID','Nom','Prenom','Ville','Telephone','Etat',);

        $callback = function () use ($commands, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($commands as $command) {
                $row = [
                    $command->id,
                    $command->date,
                    $command->client_id,
                    $command->nom,
                    $command->prenom,
                    'Agadir', 
                    $command->tele,
                    $command->etat,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $commande = Commande::with('client')->find($id);

        
        $total_prix = DB::table('ligne_de_commande')
            ->where('commande_id', $id)
            ->sum(DB::raw('prix * quantite'));
    
  
        $commande = Commande::with('client', 'ligneDeCommande')->find($id);


$total_prix = $commande->ligneDeCommande->sum(function ($item) {
    return $item->prix * $item->quantite;
});


$commande->total_prix = $total_prix;
//dd($commande);
        return view('admin.show')->with('commande', $commande);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
