@extends('app')

@section('title', '記事詳細')

@section('content')
    @include('nav')
    @include('flash')
    @include('error_card_list')
    <div class="row">
        <div class="col-lg-3">
            @include('sidebar')
        </div>
        <div class="col-lg-9">
            <div class="container mt-3">
                @include('articles.card_show')
                @include('articles.tabs', ['hasArticles' => false, 'hasMembers' => true])
                {{-- <ul class="nav nav-tabs nav-justified mt-3">
                    <li class="nav-item">
                        <a class="nav-link text-muted active"
                        href="{{route('articles.show', ['article' => $article])}}">
                        コメント
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted"
                        href="{{route('articles.member', ['article' => $article])}}">
                        参加者
                        </a>
                    </li>
                </ul> --}}
                <div class="mt-3">
                    @foreach ($users as $user)
                        @include('joins.card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection