@extends('app')
@section('title', '募集一覧')
@section('content')
    @include('nav')
    @include('flash')
    {{-- <div>
        <form action="{{route('articles.search')}}" method="get">
            @csrf
            <select name="genre_id" id="genre_id">
                @foreach ($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
            </select>
            <select name="area" id="area">
                @foreach ($articles->area as $area)
                    <option value="{{$->id}}">{{$genre->name}}</option>
                @endforeach
            </select>
        </form>
    </div> --}}
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