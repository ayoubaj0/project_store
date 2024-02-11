<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LigneDeCommande extends Pivot
{
    use HasFactory;
    protected $table='ligne_de_commande';
    protected $fillable=['commande_id','produit_id','quantite','prix'];

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
    public function produit(){
        return $this->belongsTo(Produit::class);
    }
}
