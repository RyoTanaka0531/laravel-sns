@extends('app')
@section('title', 'ジャンル一覧')
@section('content')
@include('nav')
<div>
    @foreach ($genres as $genre)
        {{$genre->name}}
    @endforeach
</div>
@endsection