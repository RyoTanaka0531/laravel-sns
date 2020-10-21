<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use App\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('articles/create');
        // $article = factory(Article::class)->create();
        // $response = $this->actingAs($user)->get('articles/{article}/edit');

        $response->assertStatus(200);
    }
}
