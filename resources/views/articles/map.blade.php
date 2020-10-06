@extends('app')
@section('title', '実施会場マップ')

@section('content')
    @include('nav')
        <div id="map" class="map"></div>
        <script>
            function initMap(){
                var MyLatLng = new google.maps.LatLng(35.465700, 139.622138); //経度と緯度を指定
                var Options = {
                    zoom:16,
                    center: MyLatLng,
                    mapTypeId: 'roadmap'
                };
                var map = new google.maps.Map(document.getElementById('map'), Options);
                var markerOptions = {
                    map:map, //マーカーを生成したいマップを指定
                    position: MyLatLng, //どこにマーカーを生成するのか
                };
                //マーカーを生成するMarkerクラス
                var marker = new google.maps.Marker(markerOptions);
            }
        </script>
            <script defer src="http://maps.google.com/maps/api/js?key={{config('services.google-map.apikey')}}&callback=initMap"></script>
@endsection