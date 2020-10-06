@extends('app')
@section('title', '実施会場マップ')

@section('content')
    @include('nav')
    <div id="content">
        <div id="map" class="map">
            <google-map></google-map>
        </div>
    </div>
@endsection