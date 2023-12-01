<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ 
        'designation'=>$this->faker->sentence,
        'prix_u'=>$this->faker->randomFloat(2,1,500),
        'quantite_stock'=>$this->faker->randomNumber(3),
        'categorie_id'=>Categorie::all()->random()->id
            //
        ];
    }
}