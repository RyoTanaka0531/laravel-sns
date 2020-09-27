<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = [
            //型キャスト:配列の手前に(object)と記述することで、配列がオブジェクト型に変換される
            (object)[
                'id' => 1,
                'title' => 'タイトル1',
                'body' => '本文1',
                'created_at' => now(),
                'user' => (object)[
                    'id' => 1,
                    'name' => 'ユーザー名1',
                ],
            ],
            (object)[
                'id' => 2,
                'title' => 'タイトル2',
                'body' => '本文2',
                'created_at' => now(),
                'user' => (object)[
                    'id' => 2,
                    'name' => 'ユーザー名2',
                ],
            ],
            (object)[
                'id' => 3,
                'title' => 'タイトル3',
                'body' => '本文3',
                'created_at' => now(),
                'user' => (object)[
                    'id' => 3,
                    'name' => 'ユーザー名3',
                ],
            ],
        ];
        return view('articles.index', ['articles' => $articles]);
    }
}
