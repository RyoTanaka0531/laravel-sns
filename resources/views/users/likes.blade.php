@extends('app')

@section('title', $user->name . 'のいいねした記事')

@section('content')
    @include('nav')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasArticles' => false, 'hasLikes' => true, 'hasJoins' => false])
        @foreach ($articles as $article)
            @include('articles.card')
        @endforeach
        <div class="row justify-content-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection