<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CategorieController;
use App\Models\Categorie;

class CategorieControllerUnitTest extends TestCase
{
     use RefreshDatabase;

     /**
     * Test creating a Categorie model.
     *
     * @return void
     */



    
    // public function testCreateCategorie()
    // {
    //     // Create a Categorie model instance
    //     $categorie = Categorie::factory()->create();

    //     // Assert the model is saved to the database
    //     $this->assertDatabaseHas('categories', ['id' => $categorie->id]);
    // }
    // public function testUpdateCategorie()
    // {
    //     // Create a Categorie model instance
    //     $categorie = Categorie::factory()->create();

    //     // Update the model attributes
    //     $categorie->update(['designation' => 'Updated Designation']);

    //     // Assert the changes are saved to the database
    //     $this->assertDatabaseHas('categories', ['id' => $categorie->id, 'designation' => 'Updated Designation']);
    // }
    // public function testDeleteCategorie()
    // {
    //     // Create a Categorie model instance
    //     $categorie = Categorie::factory()->create();

    //     // Delete the model
    //     $categorie->delete();

    //     // Assert the model is not in the database anymore
    //     $this->assertDatabaseMissing('categories', ['id' => $categorie->id]);
    // }
   
}
