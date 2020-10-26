@extends('app')
@section('title', $user->name . 'のフォロー中')

@section('content')
    @include('nav')
    <div class="container">
        @include('users.user')
        <div class="mt-3">
            <h4>フォロー</h4>
        </div>
        @foreach ($followings as $person)
            @include('users.person')
        @endforeach
    </div>
@endsection