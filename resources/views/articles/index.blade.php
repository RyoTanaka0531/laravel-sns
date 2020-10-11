@extends('app')
@section('title', '募集一覧')
@section('content')
    @include('nav')
    @include('flash')
        <div class="row">
            <div class="col-lg-3">
                @include('sidebar')
            </div>
            <div class="col-lg-9">
                <div class="container">
                    @foreach($articles as $article)
                    @include('articles.card')
                    @endforeach
                </div>
                <div class="row justify-content-center mt-3">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
@endsection