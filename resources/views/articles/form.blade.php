@csrf
<div class="md-form">
    <label>タイトル</label>
    {{-- null合体演算子は 式1 ?? 式２ の形式で記述し、式1がnullでない場合、式1が結果となり、式1がnullの場合、式2が結果となる --}}
    <input type="text" name="title" class="form-control" required value="{{$article->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="genre">スポーツのジャンル選択</label>
    <select name="genre_id" id="genre_id" class="form-control">
        @isset($article->genre->name)
            <option selected value="{{$article->genre->id}}">{{$article->genre->name}}</option>
        @else
            <option selected value="">選択して下さい</option>
        @endisset
        @foreach ($genres as $genre)
            <option value="{{$genre->id}}">{{$genre->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="tags">種目名や最寄り駅・地域名を入力してください</label>
    <article-tags-input
    {{-- このformはcreateアクションでも使用され、createでは$tagNamesを渡せない
        なので、$tagNamesがnullだった時には空の配列をコンポーネントに渡せるように考慮している --}}
    :initial-tags='@json($tagNames ?? [])'
    {{-- bladeから、vueコンポーネントにタグ情報を渡す --}}
    :autocomplete-items='@json($allTagNames ?? [])'
    >
    </article-tags-input>
</div>
<div class="form-group">
    <label for="date">実施時間</label>
    <input type="text" name="date" id="date" class="form-control" required value="{{$article->date ?? old('date')}}" placeholder="例10月10日　16:00~">
</div>
<div class="form-group">
    <label for="prefecture">開催エリア</label>
    <select name="prefecture_id" id="prefecture_id" class="form-control">
        @isset($article->prefecture->name)
            <option selected value="{{$article->prefecture->id}}">{{$article->prefecture->name}}</option>
        @else
            <option selected value="">選択して下さい</option>
        @endisset
        @foreach ($prefectures as $prefecture)
            <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="area">実施場所</label>
    <div class="row">
        <div class="col-lg-6">
            <input type="text" name="area" id="keyword" class="form-control" required value="{{$article->area ?? old('area')}}" placeholder="例)〇〇体育館">
        </div>
        <div class="col-lg-6">
            <button id="search" type="button" class="btn peach-gradient btn-block" data-toggle="modal" data-target="#modal1">
                マップで確認
            </button>
        </div>
    </div>
    <div class="modal fade" id="modal1" tabindex="-1"
        role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="member">募集人数</label>
            <select name="member" id="member" class="form-control">
                @isset($article->prefecture->name)
                    <option selected value="{{$article->member}}">{{$article->member}}</option>
                @else
                    <option selected value="">選択して下さい</option>
                @endisset
                @for ($i = 0; $i < 51; $i++)
                    <option>{{$i}}</option>
                @endfor
                {{-- <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option> --}}
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="fee">参加費</label>
            <select name="fee" id="fee" class="form-control">
                @isset($article->fee)
                    <option selected value="{{$article->fee}}">{{$article->fee}}</option>
                @else
                    <option selected value="">選択して下さい</option>
                @endisset
                <option>無料</option>
                <option>500円以内</option>
                <option>1,000円以内</option>
                <option>2,000円以内</option>
                <option>3,000円以内</option>
                <option>4,000円以内</option>
                <option>5,000円以内</option>
                <option>6,000円以内</option>
                <option>7,000円以内</option>
                <option>8,000円以内</option>
                <option>9,000円以内</option>
                <option>10,000円以内</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="deadline">募集締め切り</label>
            <input type="date" name="deadline" id="deadline" class="form-control" required value="{{$article->deadline ?? old('deadline')}}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="body">参加者へのメッセージ</label>
    <textarea name="body" required class="form-control" row="16" placeholder="例）初心者ですがよろしくお願いします！">{{$article->body ?? old('body')}}</textarea>
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