{{-- @extends('app')
@section('title', $genre->name)

@section('content')
@include('nav')
    <div container>
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="h4 card-title m-0">{{ $genre->name }}の募集</h2>
                    <div class="card-text text-right">
                        {{$genre->articles->count()}}件
                    </div>
                </h2>
            </div>
        </div>
    </div>
    @foreach ($genre->articles as $article)
        @include('articles.card')
    @endforeach
@endsection --}}

@extends('app')

@section('title', $genre->name)

@section('content')
    @include('nav')
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h2 class="h4 card-title m-0">{{ $genre->name }}の募集</h2>
                <div class="card-text text-right">
                    {{ $genre->articles->count() }}件
                </div>
            </div>
        </div>
        @foreach($genre->articles as $article)
            @include('articles.card')
        @endforeach
    </div>
@endsection