<?php

namespace Tests\Feature\API;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('db:seed');
        

        Artisan::call('passport:install');
    }

    protected function authenticate()
    {
        // Simulated landing
        $response = $this->json('POST', '/api/login', [
            'email' => 'test@gmail.com',
            'password' => 'test',
        ]);

        return $response['token'];
    }

    public function test_user_can_get_the_whole_article()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/v1/post');

        $response->assertStatus(200);
    }

    public function test_user_can_create_an_article()
    {

        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/v1/post', [
            'title' => "Cara Membuat Unit Testing",
            'content' => "Pertama install Laravel terlebih dahulu",
            'image' => "https://miro.medium.com/max/1400/1*zgYKTRI7Q270sPnsRVkDkw.png",
            'category_id' => 1,
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_search_for_an_article()
    {
        $id = 1;

        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/v1/post/' . $id);

        $response->assertStatus(200);
    }

    public function test_user_can_edit_an_article()
    {
        $id = 1;

        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('PUT', '/api/v1/post/' . $id, [
            'title' => "title ubah",
            'content' => 'ubah konten',
            'image' => 'ubahImage.jpg',
            'user_id' => 1,
            'category_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_delete_an_article()
    {

        $this->artisan('db:seed --class=PostSeeder');
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', '/api/v1/post/' . 1);

        $response->assertStatus(200);
     }
}
