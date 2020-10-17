@extends('app')

@section('title', '記事詳細')

@section('content')
    @include('nav')
    @include('flash')
    @include('error_card_list')
    <div class="row">
        <div class="col-lg-3">
            @include('sidebar')
        </div>
        <div class="col-lg-9">
            <div class="container mt-3">
                @include('articles.card_show')
                @include('articles.tabs', ['hasArticles' => true, 'hasMembers' => false])
                @foreach ($article->comments as $comment)
                    @include('articles.comment')
                @endforeach
                @include('articles.comment_form')
            </div>
        </div>
    </div>
@endsection