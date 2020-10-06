<template>
</template>
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
