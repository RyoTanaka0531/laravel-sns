<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CommentController extends Controller
{
    //
    public function store(CommentRequest $request, Comment $comment)
    {
        $comment->fill($request->all());
        $comment->save();
        return redirect()->route('articles.show', ['article' => $comment->article])
            ->with('flash_message', 'コメントを投稿しました');
    }
}
