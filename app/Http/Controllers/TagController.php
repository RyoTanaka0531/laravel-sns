<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();
        $now = now();
        return view('tags.show', ['tag' => $tag, 'now' => $now]);
    }
}
