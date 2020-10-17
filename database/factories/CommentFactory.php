<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->realText(20),
        'user_id' => $faker->numberBetween(1,5),
        'article_id' => $faker->numberBetween(1,10),
        //
    ];
});
