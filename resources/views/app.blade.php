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
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

</head>
<body>
    {{-- id=app resources/js/app.jsに定義したVueコンポーネントを各Bladeで使えるようにする --}}
    <div id="app" class="mb-5">
        @yield('content')
    </div>
    <footer class="footer fixed-bottom">
        <div class="container text-center">
            <span>©︎ sport.2020.</span>
        </div>
    </footer>

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

    {{-- googlemap --}}
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('services.google-map.apikey')}}&callback=initMap" async defer></script>
</body>
</html>