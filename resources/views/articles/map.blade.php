@extends('app')
@section('title', '実施会場マップ')

@section('content')
    @include('nav')
    <div>
        <input type="text" id="addressInput2" value="大坂城" style="width: 250px">
        <input type="button" value="緯度・経度取得" onclick="getIdoKeidoMap();">
        <br /><br />
        <div id="mapArea" style="width:1000px; height:600px; border: 1px solid"></div>
      </div>
      
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?key={{config('services.google-map.apikey')}}"></script>
      <!--「key=xxxxxxxxxx」にはGoogleで取得したAPIキーを記述します -->
      
      <script type="text/javascript">
      //地図の初期表示
      new google.maps.Map(document.getElementById("mapArea"), {
        zoom: 10,
        center: new google.maps.LatLng(36,138),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      
      function getIdoKeidoMap() {
      
        var addressInput = document.getElementById('addressInput2').value;
        var geocoder = new google.maps.Geocoder();
      
        geocoder.geocode({
          address: addressInput
        }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
      
            //Mapクラスのインスタンスを生成します。
            var map = new google.maps.Map(
              document.getElementById("mapArea"),
              {
                mapTypeId: google.maps.MapTypeId.ROADMAP
              }
            );
            
            //表示範囲クラスのインスタンスを生成します。
            var bounds = new google.maps.LatLngBounds();
            
            for (var i in results) {
              if (results[i].geometry) {
      
                //緯度・経度情報を取得します。
                var latlng = results[i].geometry.location;
      
                //住所を取得します。
                var address = results[i].formatted_address;
      
                //取得した緯度・経度で表示範囲を拡張します。
                bounds.extend(latlng);
      
                //地図上に緯度・経度、住所の情報を表示します。
                new google.maps.InfoWindow(
                  {
                    content: "(緯度, 経度) = " + latlng.toString() +
                             "<br />" + address
                  }
                ).open(
                  map,
                  new google.maps.Marker(
                    {
                      position: latlng,
                      map: map
                    }
                  )
                );
              }
            }
      
            //表示範囲に移動します。
            map.fitBounds(bounds);
            //地図のズームを設定します。
            map.setZoom(3);
      
          } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
            alert("住所が見つかりませんでした。");
          } else if (status == google.maps.GeocoderStatus.ERROR) {
            alert("サーバ接続に失敗しました。");
          } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
            alert("リクエストが無効でした。");
          } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
            alert("リクエストの制限回数を超えました。");
          } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
            alert("サービスが使えない状態でした。");
          } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
            alert("原因不明のエラーが発生しました。");
          }
        });
      }
      </script>
@endsection