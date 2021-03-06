<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Genre;
use App\Prefecture;


class UserController extends Controller
{
    //
    public function show(string $name)
    {
        $now = now();
        $user = User::where('name', $name)->first();
            // ->load(['articles.user', 'articles.likes', 'articles.tags', 'articles']);
        $articles = $user->articles()->orderBy('created_at', 'DESC')->paginate(10);
        $articles->load('genre', 'prefecture', 'likes', 'comments', 'tags', 'joins', 'user');
        return view('users.show', ['user' => $user, 'articles' => $articles, 'now' => $now]);
    }

    //!!nameにはフォローされる側の名前が入る!!
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['followings.followers']);

        if($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        //detachしてからattchしているのは1人のユーザーがあるユーザーを複数回重ねてフォローするのを防ぐため
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);
        //配列や連想配列で返すと、JSON形式に変換されてレスポンスされる
        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['followers.followers']);

        if($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        return ['name' => $name];
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();
            // ->load(['likes.user', 'likes.likes', 'likes.tags']);
        // $articles = $user->likes->sortByDesc('created_at')->paginate(10);
        $articles = $user->likes()->orderBy('created_at', 'DESC')->paginate(10);
        $articles->load(['user', 'comments', 'likes', 'tags', 'joins', 'genre', 'prefecture']);
        $now = now();
        return view('users.likes', ['user' => $user, 'articles' => $articles, 'now' => $now]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();
        $followings = $user->followings->sortByDesc('created_at');
        return view('users.followings', ['user' => $user, 'followings' => $followings]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();
        $followers = $user->followers->sortByDesc('create_at');
        return view('users.followers', ['user' => $user, 'followers' => $followers]);
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();
        $genres = Genre::all();
        $prefectures = Prefecture::all();
        $this->authorize('update', $user);
        return view('users.edit', ['name' => $name, 'user' => $user,
                                    'genres' => $genres, 'prefectures' => $prefectures ]);
    }

    public function update(UserRequest $request, string $name, Genre $genre)
    {
        $user = User::where('name', $name)->first();
        $this->authorize('update', $user);
        $user->fill($request->all());
        if ($request->file('image')){
            $path = $request->file('image')->store('public/img');
            $user->image = basename($path);
        }
        $user->save();
        return redirect("/");
    }

    public function joins(string $name)
    {
        $user = User::where('name', $name)->first();
        $articles = $user->joins()->orderBy('deadline', 'DESC')->paginate(10);
        $articles->load(['user', 'comments', 'likes', 'tags', 'joins', 'genre', 'prefecture']);
        $prefectures = Prefecture::all();
        $now = now();
        return view('users.joins', ['user' => $user, 'articles' => $articles,
                                    'prefectures' => $prefectures, 'now' => $now]);
    }
}
