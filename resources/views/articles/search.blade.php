@extends('app')
@section('title', '検索結果')
@section('content')
    @include('nav')
        <div>
            <form action="{{route('articles.search'))}}" method="post">
                <select name="genre_id" id="genre_id"></select>
            </form>
        </div>
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