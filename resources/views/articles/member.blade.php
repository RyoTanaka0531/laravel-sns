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
                <div class="mt-3">
                    @foreach ($users as $user)
                        @include('joins.card')
                    @endforeach
                    <div class="row justify-content-center mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection