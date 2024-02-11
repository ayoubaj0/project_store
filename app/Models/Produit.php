<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $fillable =[
        'designation',
        'prix_u',
        'quantite_stock',
        'categorie_id'
    ];
    public function categorie(){
       return  $this->belongsTo(Categorie::class);
    }
    public function commandes(){
        return $this->belongsToMany(Commande::class)->using(LigneDeCommande::class);
    }
}
