<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $articles = $user->articles->sortByDesc('created_at');
        return view('users.show', ['user' => $user, 'articles' => $articles]);
    }

    //!!nameにはフォローされる側の名前が入る!!
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

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
        $user = User::where('name', $name)->first();

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
        $articles = $user->likes->sortByDesc('created_at');
        return view('users.likes', ['user' => $user, 'articles' => $articles]);
    }
}
