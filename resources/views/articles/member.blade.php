@extends('app')
@section('title', '参加者一覧')
@section('content')
@include('nav')
<div class="container">
    <div class="mt-3">
        <h4>参加者一覧</h4>
    </div>
    <div class="ml-auto">
        <a href="{{route('articles.member', ['article' => $article])}}"><i class="fas fa-user mr-1"></i></a>
        募集人数: {{$article->count_joins}}人 / {{$article->member}}人
    </div>
        @foreach ($users as $user)
        <div class="mt-3">

            @include('joins.card')
            @endforeach
        </div>
</div>
@endsection