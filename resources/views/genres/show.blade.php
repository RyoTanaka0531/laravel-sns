@extends('app')

@section('title', $genre->name)

@section('content')
    @include('nav')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <h2 class="h4 card-title m-0">{{ $genre->name }}の募集</h2>
                <div class="card-text text-right">
                    {{ $genre->articles->count() }}件
                </div>
            </div>
        </div>
        @foreach($articles as $article)
            <div class="mt-3">
                @include('articles.card')
            </div>
        @endforeach
        <div class="row justify-content-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
@endsection