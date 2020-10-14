<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div>
                <i class="fas fa-search mr-1"></i><span>募集情報を探す</span>
            </div>
            <form action="{{route('articles.search')}}" method="post">
                <div class="row justify-content-center">
                    <div class="col-lg-2">
                        <div class="card-text">
                            <label for="genre_id" class="mt-4">スポーツの種類</label>
                            <label for="prefecture_id" class="mt-3">開催エリア</label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            @csrf
                            @method('GET')
                            <select name="genre_id" id="genre_id" class="form-control mt-2">
                                <option value="" selected>選択して下さい</option>
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                @endforeach
                            </select>
                            <select name="prefecture_id" id="prefecture_id" class="form-control mt-2">
                                <option value="" selected>選択して下さい</option>
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-lg-4 offset-lg-1 mt-5">
                            <button type="submit" class="btn peach-gradient">この条件で検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>