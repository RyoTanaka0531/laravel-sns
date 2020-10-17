<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'body' => $faker->realText(30),
        'user_id' =>$faker->numberBetween(1,5),
        'date' =>$faker->dateTimeThisMonth->format('Y-m-d'),
        'area' => $faker->city,
        'genre_id' => $faker->numberBetween(1,15),
        'prefecture_id' =>$faker->numberBetween(1,47),
        'deadline' => $faker->dateTimeThisMonth->format('Y-m-d'),
        'member' => $faker->numberBetween(1,50),
        'fee' => $faker->numberBetween(500, 10000),
        //
    ];
});
