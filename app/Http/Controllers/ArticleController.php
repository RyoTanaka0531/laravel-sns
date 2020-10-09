<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use App\Comment;
use App\Genre;

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
        // $articles = Article::paginate(10)->sortByDesc('created_at');]
                //遅延Eagerロードの使用
                // ->load(['user', 'likes', 'tags']);
        return view('articles.index', ['articles' => $articles, 'genres' => $genres]);
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function($tag){
            return ['text' => $tag->name];
        });
        $genres = Genre::all();
        return view('articles.create', [
            'allTagNames' => $allTagNames,
            'genres' => $genres,
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
        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
            'genres' => $genres,
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
        return view('articles.show', ['article' => $article, 'genres' => $genres]);
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

    public function search(Request $request, Article $article)
    {
        $article = Article::where('name', $article->genre->name);
        $article = Article::where('name', $article->genre->name)
            ->where('area', $article->area)->get();

        return view('articles.search', ['article' => $article]);
    }
}
