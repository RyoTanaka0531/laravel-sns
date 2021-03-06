@extends('app')
@section('title', '募集一覧')
@include('nav')
@section('content')
    @include('flash')
    @include('eyecatch')
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-3">
                @include('sidebar')
            </div>
            <div class="col-lg-9">
                @include('articles.search_form')
                @foreach($articles as $article)
                    <div class="mt-3">
                        @include('articles.card')
                    </div>
                @endforeach
                <div class="row justify-content-center mt-3">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection