@extends('app')

@section('title', $user->name)

@section('content')
    @include('nav')
    <div class="container">
        @include('users.user')
        @include('users.tabs', ['hasArticles' => true, 'hasLikes' => false, 'hasJoins' => false])
        @foreach ($articles as $article)
            <div class='mb-3'>
                @include('articles.card')
            </div>
        @endforeach
        <div class="row justify-content-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
