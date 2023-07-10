<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // migrate database
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');

        // login
        $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'test',
        ]);
    }

    public function test_categories_screen_can_be_rendered()
    {
        $response = $this->get('/category');
        $response->assertStatus(200);
    }

    public function test_form_create_category_screen_can_be_rendered()
    {
        $response = $this->get('/category/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_an_category()
    {
        $response = $this->post('/category', [
            'id' => 1,
            'name' => "Tutorial",
        ]);

        $this->assertDatabaseHas('category', [
            'name' => "Tutorial",
        ]);

        $response = $this->get('/category');
        $response->assertStatus(200);
    }

    public function test_user_can_edit_an_category()
    {
        $id = 1;

        $response = $this->put('/category/' . $id, [
            'name' => "Category ubah",
            'user_id' => 1
        ]);

        $response = $this->get('/category');
        $response->assertStatus(200);
    }

    public function test_user_can_delete_an_category()
    {
        $id = 1;

        $response = $this->delete('/category/' . $id);

        $this->assertDatabaseMissing('category', [
            'id' => 1,
        ]);

        $response = $this->get('/category');
        $response->assertStatus(200);
    }
}
