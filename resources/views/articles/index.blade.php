@extends('app')
@section('title', '記事一覧')
@section('content')
    @include('nav')
    @include('flash')
    <div class="container">
        @foreach($articles as $article)
            @include('articles.card')
        @endforeach
    </div>
    <div class="row justify-content-center mt-3">
        {{ $articles->links() }}
    </div>
@endsection