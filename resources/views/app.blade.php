<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- MDBootstrap公式サイトの導入方法 --}}
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    {{-- Material Design Bootstrap --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
</head>
<body>
    {{-- id=app resources/js/app.jsに定義したVueコンポーネントを各Bladeで使えるようにする --}}
    <div id="app">
        @yield('content')
    </div>

    {{-- この/js/app.jsはlaravel/public/js/app.jsのこと --}}
    <script src="{{mix('js/app.js')}}"></script>
    {{-- JQuery --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- Bootstrap tooltips --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    {{-- Bootstrap core JavaScript --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{-- MDB core JavaScript --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

    <style>
        #map{
            height: 600px;
        }
    </style>
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
</body>
</html>