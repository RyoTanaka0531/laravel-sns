<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->delete();
        $genre_seeds = [
            ['name' => 'フットサル'],
            ['name' => 'サッカー'],
            ['name' => '野球'],
            ['name' => 'テニス'],
            ['name' => 'バスケットボール'],
            ['name' => 'バレーボール'],
            ['name' => 'バドミントン'],
            ['name' => '卓球'],
            ['name' => 'ゴルフ'],
            ['name' => 'ボウリング'],
            ['name' => 'ソフトボール'],
            ['name' => 'ランニング・マラソン'],
            ['name' => 'ヨガ'],
            ['name' => 'ボルダリング'],
            ['name' => 'アウトドアスポーツ'],
        ];
        foreach($genre_seeds as $genre){
            DB::table('genres')->insert($genre);
        }
    }
}
