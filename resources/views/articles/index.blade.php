@extends('app')
@section('title', '募集一覧')
@include('nav')
@section('content')
    @include('flash')
        <div class="row">
            <div class="col-lg-3">
                @include('sidebar')
            </div>
            <div class="col-lg-9">
                <div class="container">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div>
                                <i class="fas fa-search mr-1"></i><span>募集情報を探す</span>
                            </div>
                            <form action="{{route('articles.search')}}" method="post">
                                <div class="row justify-content-center">
                                    <div class="col-lg-2">
                                        <div class="card-text">
                                            <label for="keyword" class="mt-1">キーワード入力</label>
                                            <label for="genre_id" class="mt-3">スポーツの種類</label>
                                            <label for="prefecture_id" class="mt-3">開催エリア</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                            @csrf
                                            @method('GET')
                                            <input type="text" name="title" id="title" class="form-control" placeholder="キーワード">
                                            {{-- <select name="genre_id" id="genre_id" class="form-control mt-2">
                                                <option value="" selected>選択して下さい</option>
                                                @foreach ($genres as $genre)
                                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                                @endforeach
                                            </select>
                                            <select name="prefecture_id" id="prefecture_id" class="form-control mt-2">
                                                <option value="" selected>選択して下さい</option>
                                                @foreach ($prefectures as $prefecture)
                                                    <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
                                                @endforeach
                                            </select> --}}
                                    </div>
                                    <div class="col-lg-4 offset-lg-1 mt-5">
                                            <button type="submit" class="btn peach-gradient">この条件で検索</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
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