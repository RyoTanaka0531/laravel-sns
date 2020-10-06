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
        // $request->user()->comments()->save($comment);
        $comment->save();
        return redirect()->route('articles.show', ['article' => $comment->article])
            ->with('flash_message', 'コメントを投稿しました');
    }
    // public function store(Request $request)
    // {
    //     $validate_rule = [
    //         'article_id' => 'required|exists:articles,id',
    //         'message' => 'required|max:2000',
    //     ];
    //     $this->validate($request, $validate_rule);
    //     $params = $request->all();
    //     return $params;
    //     return redirect()->route('articles.show', ['id' => $request->article_id]);

    // }
}
