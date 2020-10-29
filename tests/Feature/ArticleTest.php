<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        $article = factory(Article::class)->create();

        $result = $article->isLikedBy(null);

        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $article->likes()->attach($user);

        $result = $article->isLikedBy($user);

        $this->assertTrue($result);
    }

    public function testIsLikedByAnother()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $article ->likes()->attach($another);

        $result = $article->isLikedBy($user);

        $this->assertFalse($result);
    }

    public function testIsJoinedByNull()
    {
        $article = factory(Article::class)->create();
        $result = $article->isJoinedBy(null);
        $this->assertFalse($result);
    }

    public function testIsJoinedByTheUser()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $article->joins()->attach($user);
        $result = $article->isJoinedBy($user);
        $this->assertTrue($result);
    }

    public function testIsJoinedByTheAnother()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $article->joins()->attach($another);

        $result = $article->isJoinedBy($user);
        $this->assertFalse($result);
    }
}
