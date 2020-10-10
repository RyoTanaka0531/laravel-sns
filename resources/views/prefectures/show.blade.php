@extends('app')

@section('title', $prefecture->name)

@section('content')
    @include('nav')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="h4 card-title m-0">{{ $prefecture->name }}での募集</h2>
                <div class="card-text text-right">
                    {{ $prefecture->articles->count() }}件
                </div>
            </div>
        </div>
        @foreach($prefecture->articles as $article)
            @include('articles.card')
        @endforeach
    </div>
@endsection