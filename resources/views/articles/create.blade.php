@extends('app')
@section('title', '記事登録')

@include('nav')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    @include('error_card_list')
                    @include('flash')
                    <div class="card-body pt-0">
                        <div class="card-text">
                            <form action="{{route('articles.store')}}" method="post">
                                @include('articles.form')
                                <button class="btn btn-block" type="submit">投稿する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection