@extends('app')
@section('title', $user->name . 'のフォロワー')

@section('content')
    @include('nav')
    <div class="container">
        @include('users.user')
        <div class="mt-3">
            <h4>フォロワー</h4>
        </div>
        @foreach ($followers as $person)
            @include('users.person')
        @endforeach
    </div>
@endsection