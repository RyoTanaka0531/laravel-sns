<input type="hidden" id="keyword" name="keyword" value="{{$article->area}}">
{{-- <button id="search" data-toggle="modal" data-target="#modal2">場所はこちら</button> --}}


<button id="search" type="button" class="btn peach-gradient btn-block" data-toggle="modal" data-target="#modal1">
    実施場所をマップで確認
</button>
<div class="modal fade" id="modal1" tabindex="-1"
        role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label1">{{$article->area}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="target" style="width: 770px; height: 600px"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{config('services.google-map.apikey')}}&callback=initMap" async defer></script>
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
                // マーカーへの吹き出しの追加
                // setInfoW(place, latlng, address);
                // マーカーにクリックイベントを追加
                markerEvent();
                }
            }
            map.fitBounds(bounds);
            map.setZoom(16);
            } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("場所が見つかりません。住所で入力してみて下さい。");
            } else {
            console.log(status);
            alert("エラー発生");
            }
        });
    });
}

// マーカーのセットを実施する
function setMarker(setplace) {
    // // 既にあるマーカーを削除
    // deleteMakers();

    // var iconUrl = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
    marker = new google.maps.Marker({
        position: setplace,
        map: map,
        // icon: iconUrl
    });
}

    //マーカーを削除する
    // function deleteMakers() {
    // if(marker != null){
    //     marker.setMap(null);
    // }
    // marker = null;
    // }

    // マーカーへの吹き出しの追加
    // function setInfoW(place, latlng, address) {
    //     infoWindow = new google.maps.InfoWindow({
    //     content: "<a href='http://www.google.com/search?q=" + place + "' target='_blank'>" + place + "</a><br><br>" + latlng + "<br><br>" + address + "<br><br><a href='http://www.google.com/search?q=" + place + "&tbm=isch' target='_blank'>画像検索 by google</a>"
    // });
    // }

// クリックイベント
function markerEvent() {
    marker.addListener('click', function() {
    infoWindow.open(map, marker);
    });
}

</script>