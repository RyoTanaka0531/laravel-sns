<input type="hidden" id="keyword" value="{{$article->area}}">
<button id="search" type="button" class="btn peach-gradient btn-block" data-toggle="modal" data-target="#modal1">
    <h5>実施場所をマップで確認</h5>
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
            </div>
        </div>
    </div>
</div>
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
            map.setZoom(18);
            } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("場所が見つかりません。主催者に確認して下さい。");
            } else {
            console.log(status);
            alert("");
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