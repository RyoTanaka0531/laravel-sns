<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->realText(20),
        'user_id' => function(){
            return factory(User::class);
        },
        'article_id' => function(){
            return factory(Article::class);
        },
        //
    ];
});
