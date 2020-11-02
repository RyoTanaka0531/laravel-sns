<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    public function testUser()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        //ログイン状態でない場合にarticles/createに遷移できない
        $response = $this->get('articles/create');
        $response->assertStatus(302);

        //ログイン状態でarticles/createに遷移できる
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('articles/create');
        $response->assertStatus(200);
    }
}
