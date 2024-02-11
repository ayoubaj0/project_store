<?php

namespace App\Models;

use App\Models\LigneDeCommande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=['date','client_id','etat'];
    public function ligneDeCommande()
    {
        return $this->hasMany(LigneDeCommande::class, 'commande_id');
    }

    // public function produits(){
    //     return $this->belongsToMany(Produit::class)->using(LigneDeCommande::class);
    // }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
