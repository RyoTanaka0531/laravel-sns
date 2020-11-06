<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use App\Genre;
use App\Prefecture;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'body' => $faker->realText(30),
        // 'user_id' =>$faker->numberBetween(1,5),
        //articleモデルをファクトリで生成した時に併せてUserモデルがファクトリで生成され、そのUserモデルのID
        //がarticleモデルのuser_idカラムにセットされるようになる。
        'user_id' => function(){
            return factory(User::class);
        },
        'date' =>$faker->dateTimeThisMonth->format('Y-m-d'),
        'area' => $faker->city,
        //テスト用のデータ　seederを作る場合は適応できない
        //seederの場合、numberBetweenを適応させる。
        'genre_id' => function(){
            return factory(Genre::class);
        },
        //テスト用のデータ　seederを作る場合は適応できない
        //seederの場合、numberBetweenを適応させる。
        'prefecture_id' => function(){
            return factory(Prefecture::class);
        },
        'deadline' => $faker->dateTimeThisMonth->format('Y-m-d'),
        'member' => $faker->numberBetween(1,50),
        'fee' => $faker->numberBetween(500, 10000),
        //
    ];
});
