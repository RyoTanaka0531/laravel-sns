<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;


class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testFollow()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();

        $user->followings()->attach($another);

        $result = $another->isFollowedBy($user);
        $this->assertTrue($result);
    }

    public function testUnfollow()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();

        $user->followings()->attach($another);
        $user->followings()->detach($another);
        $result = $another->isFollowedBy($user);
        $this->assertFalse($result);
    }
}
