<div id="header"><b>Google Maps - 場所検索</b></div>
<div>施設名称検索 （例：マチュピチュ、万里の長城）</div>
<input type="text" id="keyword" name="keyword" value="{{$article->area}}"><button id="search"></button>
<button id="clear">結果クリア</button>
<div id="target" style="width: 600px; height: 600px"></div>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('services.google-map.apikey')}}&callback=initMap" async defer></script>

<script>

var map;
var marker;
var infoWindow;

function initMap() {

    //マップ初期表示の位置設定
    var target = document.getElementById('target');
    var centerp = {lat: 37.67229496806523, lng: 137.88838989062504};

    //マップ表示
    map = new google.maps.Map(target, {
    center: centerp,
    zoom: 10,
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
            // マーカーへの吹き出しの追加
            setInfoW(place, latlng, address);
            // マーカーにクリックイベントを追加
            markerEvent();
            }
        }
        map.fitBounds(bounds);
        map.setZoom(15);
        } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
        alert("見つかりません");
        } else {
        console.log(status);
        alert("エラー発生");
        }
    });

    });

    // 結果クリアーボタン押下時
    document.getElementById('clear').addEventListener('click', function() {
    deleteMakers();
    });

}

// マーカーのセットを実施する
function setMarker(setplace) {
    // 既にあるマーカーを削除
    deleteMakers();

    var iconUrl = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
    marker = new google.maps.Marker({
        position: setplace,
        map: map,
        icon: iconUrl
    });
    }

    //マーカーを削除する
    function deleteMakers() {
    if(marker != null){
        marker.setMap(null);
    }
    marker = null;
    }

    // マーカーへの吹き出しの追加
    function setInfoW(place, latlng, address) {
        infoWindow = new google.maps.InfoWindow({
        content: "<a href='http://www.google.com/search?q=" + place + "' target='_blank'>" + place + "</a><br><br>" + latlng + "<br><br>" + address + "<br><br><a href='http://www.google.com/search?q=" + place + "&tbm=isch' target='_blank'>画像検索 by google</a>"
    });
    }

    // マーカーへの吹き出しの追加
    function setInfoW(place, latlng, address) {
    infoWindow = new google.maps.InfoWindow({
    content: "<a href='http://www.google.com/search?q=" + place + "' target='_blank'>" + place + "</a><br><br>" + latlng + "<br><br>" + address + "<br><br><a href='http://www.google.com/search?q=" + place + "&tbm=isch' target='_blank'>画像検索 by google</a>"
    });
}

// クリックイベント
function markerEvent() {
    marker.addListener('click', function() {
    infoWindow.open(map, marker);
    });
}

</script>