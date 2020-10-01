@extends('app')
@section('title', '記事登録')

@include('nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-body pt-0">
                        @include('error_card_list')
                        <div class="card-text">
                            <form action="{{route('articles.store')}}" method="post">
                                @include('articles.form')
                                <button class="btn blue-gradient btn-block" type="submit">投稿する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection