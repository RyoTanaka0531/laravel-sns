<template>

</template>
<style>
    #map{
        height: 600px;
    }
</style>
<script>
    var map;
    var marker;
    var infoWindow;
    
    function initMap() {
    
        //マップ初期表示の位置設定
        var target = document.getElementById('target');
        var centerp = {lat: 35.689614, lng: 139.691585};
    
        //マップ表示
        map = new google.maps.Map(target, {
        center: centerp,
        zoom: 5,
        });
    
        // 検索実行ボタンが押下されたとき
        document.getElementById('search').addEventListener('click', function() {
    
            var place = document.getElementById('keyword').value;
            var geocoder = new google.maps.Geocoder();      // geocoderのコンストラクタ
    
            geocoder.geocode({
                address: place
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
    
                var bounds = new google.maps.LatLngBounds();
    
                for (var i in results) {
                    if (results[0].geometry) {
                    // 緯度経度を取得
                    var latlng = results[0].geometry.location;
                    // 住所を取得
                    var address = results[0].formatted_address;
                    // 検索結果地が含まれるように範囲を拡大
                    bounds.extend(latlng);
                    // マーカーのセット
                    setMarker(latlng);
                    // マーカーにクリックイベントを追加
                    markerEvent();
                    }
                }
                map.fitBounds(bounds);
                map.setZoom(17);
                } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                alert("場所が見つかりません。住所で入力し、再度お試しください。");
                } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
                alert("実施場所が未入力です。");
                } else {
                console.log(status);
                alert("エラー発生");
                }
            });
        });
    }
    // マーカーのセットを実施する
    function setMarker(setplace) {
        marker = new google.maps.Marker({
            position: setplace,
            map: map,
        });
    }
    // クリックイベント
    function markerEvent() {
        marker.addListener('click', function() {
        infoWindow.open(map, marker);
        });
    }
</script>