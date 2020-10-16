@extends('app')
@section('title', '募集一覧')
@section('footer')
@include('nav')
@section('content')
    @include('flash')
        <div class="row">
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
@endsection