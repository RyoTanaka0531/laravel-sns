<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use App\Comment;
use App\Genre;
use App\Prefecture;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //
    public function __construct()
    {
        //ArticlePolicyとの対応関係を行う
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->paginate(5);
        $genres = Genre::all();
        $prefectures = Prefecture::all();
        $now = now();
        // $articles = Article::paginate(10)->sortByDesc('created_at');]
                //遅延Eagerロードの使用
                // ->load(['user', 'likes', 'tags']);
        return view('articles.index', ['articles' => $articles, 'genres' => $genres,
                                        'now' => $now, 'prefectures' => $prefectures]);
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function($tag){
            return ['text' => $tag->name];
        });
        $genres = Genre::all();
        $prefectures = Prefecture::all();
        return view('articles.create', [
            'allTagNames' => $allTagNames,
            'genres' => $genres,
            'prefectures' => $prefectures,
        ]);
    }

    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        //$request->tagsはArticleRequestのpassedValidationメソッドにより、コレクションになっているので、eachメソッドが利用できる
        //クロージャ内ではクロージャ外で定義されている変数を使用できない
        //use (article)  クロージャの中での処理で変数$articleを使う記述
        $request->tags->each(function ($tagName) use ($article){
            //firstOrCreate 引数のカラム名と値のペアを持つレコードがテーブルに存在するか探し、なければ作成する
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        return redirect()->route('articles.index')->with('flash_message','投稿が完了しました');
    }

    public function edit(Article $article)
    {
        //ArticleTagsInput.vueでタグ名に対し、textというキーがついているのでeditアクションでも
        //mapメソッドを使い同様の連想配列を作る
        $tagNames = $article->tags->map(function($tag){
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag){
            return ['text' => $tag->name];
        });

        $genres = Genre::all();
        $prefectures = Prefecture::all();
        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
            'genres' => $genres,
            'prefectures' => $prefectures,
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        //detachメソッドに引数なしで利用する場合、中間テーブルのレコードは全削除される
        $article->tags()->detach();
        $request->tags->each(function ($tagName) use ($article){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
        return redirect()->route('articles.index')->with('flash_message','投稿を更新しました');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('flash_message','投稿を削除しました');
    }

    public function show(Article $article)
    {
        $article->comments = Comment::where('article_id', $article->id)->orderBy('created_at', 'DESC')->paginate(10);
        $genres = Genre::all();
        $now = now();
        return view('articles.show', ['article' => $article, 'genres' => $genres, 'now' => $now]);
    }

    public function like(Request $request, Article $article)
    {
        //attach:新規登録、detach:削除
        //必ず削除を行っているのは、同じユーザーが何度もいいねをしないようにするため
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function map(Article $article)
    {
        $article = Article::where('id', $article->id);
        return view('articles.map', ['article' => $article]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $now = now();
        $genres = Genre::all();

        if(!empty($keyword))
        {
            //orWhereHasメソッドでキーワードがarticle,genre,prefectureのどれかに当てはまるように検索
            $articles = Article::where('title', 'like', '%'.$keyword.'%')
                ->orWhereHas('prefecture', function($query) use ($keyword){
                    if($keyword === '東京'){
                        $query->where('name', '東京都');
                    }elseif($keyword === '京都'){
                        $query->where('name', '京都府');
                    }else{
                        $query->where('name', 'like', '%'.$keyword.'%');
                    }
                })
                ->orWhereHas('genre', function($query) use ($keyword){
                    $query->where('name', 'like', '%'.$keyword.'%');
                })->paginate(4);
        }elseif(!empty($genre_id)){
            $genre = $request->genre_id;
            $articles = Article::has('genre')->where('genre_id', $genre)->paginate(10);
        }elseif(!empty($prefecture_id)){
            $prefecture = $request->prefecture_id;
            $articles = Article::has('prefecture')->where('prefecture_id', $prefecture)->paginate(10);
        }else{
            $articles = Article::paginate(10);
        }
        return view('articles.search', ['articles' => $articles, 'now' => $now, 'genres' => $genres]);




        //ジャンル検索
        // $keyword = $request->name;
        // if(!empty($keyword)){
        //     $genre = Genre::where('name', 'like', '%'.$keyword.'%')->first();
        // }
        // return view('genres.show', ['genre' => $genre, 'now' => $now]);

        //キーワード検索
        // $keyword = $request->keyword;
        // if(!empty($keyword)){
        //     $query = Article::query();
        //     $articles = $query->where('title', 'like', '%'.$keyword.'%')->paginate(10);
        // }
        // $now = now();
        // $genres = Genre::all();
        // return view('articles.search', ['articles' => $articles, 'now' => $now, 'genres' => $genres]);

        //エリア検索
        // $keyword = $request->name;
        // if(!empty($keyword)){
        // $prefecture = Prefecture::where('name', 'like', '%'.$keyword.'%')->first();
        // }
        // $now = now();
        // return view('prefectures.show', ['prefecture' => $prefecture, 'now' => $now]);
    }

}
