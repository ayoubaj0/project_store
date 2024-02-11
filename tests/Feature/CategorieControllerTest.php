<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categorie ;

class CategorieControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing categories.
     *
     * @return void
     */
    public function testIndex()
    {
       
        $categories = Categorie::factory(3)->create();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->designation);
        }
    }

    public function testStore()
    {
        $data = [
            'designation' => 'Test Category',
            'description' => 'Test Description',
        ];

        $response = $this->post(route('categories.store'), $data);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', $data);
    }
    
    public function testDestroy()
    {

        $category = Categorie::factory()->create();

        $response = $this->delete(route('categories.destroy', ['category' => $category->id]));

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
    
}
