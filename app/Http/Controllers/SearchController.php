<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class SearchController extends Controller
{
    public function show(Request $request, Article $article)
    {
        $search1 = $request->input('genre_id', $article->genre->name);
        $search2 = $request->input('prefecture_id', $article->prefecture->name);
        $search3 = $request->input('title');

        if ($request->has('genre_id') && $search1 != ('選択して下さい')){
            Article::where('genre_id', $search1)->get();
        }

        if($request->has('prefecture_id') && $search2 != ('選択して下さい')){
            Article::where('prefecture_id', $search2)->get();
        }

        if ($request->has('title') && $search3 != ''){
            Article::where('title', 'like', '%'.$search3.'%')->get();
        }

        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);
    }
}
