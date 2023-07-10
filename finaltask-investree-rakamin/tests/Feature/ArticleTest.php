<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator as Faker;
use Tests\TestCase;

class ArticleTest extends TestCase
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

    public function test_articles_screen_can_be_rendered()
    {
        $response = $this->get('/article');
        $response->assertStatus(200);
    }

    public function test_form_create_article_screen_can_be_rendered()
    {
        $response = $this->get('/article/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_an_article()
    {
        $response = $this->post('/article', [
            'id' => 1,
            'title' => "Cara Membuat Unit Testing",
            'content' => "Pertama install Laravel terlebih dahulu",
            'image' => "https://miro.medium.com/max/1400/1*zgYKTRI7Q270sPnsRVkDkw.png",
            'user_id' => 1,
            'category_id' => 1,
        ]);

        $response = $this->get('/article');
        $response->assertStatus(200);
    }

    public function test_user_can_edit_an_article()
    {
        $id = 1;

        $response = $this->put('/article/' . $id, [
            'title' => "Cara Membuat Unit Testing di Laravel",
            'content' => "Konten Unit testing",
            'image' => "test.jpg",
            'user_id' => 1,
            'category_id' => 1
        ]);
        $response = $this->get('/article');
        $response->assertStatus(200);
    }

    public function test_user_can_delete_an_article()
    {
        $id = 1;
        $response = $this->delete('/article/' . $id);

        $response = $this->get('/article');
        $response->assertStatus(200);
    }
}
