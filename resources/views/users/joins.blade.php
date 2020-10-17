@extends('app')

@section('title', $user->name . 'の参加した募集')

@section('content')
    @include('nav')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasArticles' => false, 'hasLikes' => false, 'hasJoins' => true])
        @foreach ($articles as $article)
            <div class="mt-3">
                @include('articles.card')
            </div>
        @endforeach
        <div class="row justify-content-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection