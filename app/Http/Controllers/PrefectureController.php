<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prefecture;

class PrefectureController extends Controller
{
    public function show(string $name)
    {
        $prefecture = Prefecture::where('name', $name)->first();
        $articles = $prefecture->articles()->orderBy('deadline', 'DESC')->paginate(10);
        $now = now();
        return view('prefectures.show', ['prefecture' => $prefecture, 'now' => $now, 'articles' => $articles]);
    }
}
