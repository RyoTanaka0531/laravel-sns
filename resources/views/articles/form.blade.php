@csrf
<div class="md-form">
    <label>タイトル</label>
    {{-- null合体演算子は 式1 ?? 式２ の形式で記述し、式1がnullでない場合、式1が結果となり、式1がnullの場合、式2が結果となる --}}
    <input type="text" name="title" class="form-control" required value="{{$article->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="tags">タグ</label>
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
    <label for="area">実施場所</label>
    <input type="text" name="area" id="area" class="form-control" required value="{{$article->area ?? old('area')}}" placeholder="例)〇〇体育館">
</div>

<div class="form-group">
    <label for="body">参加者へのメッセージ</label>
    <textarea name="body" required class="form-control" row="16" placeholder="例）初心者ですがよろしくお願いします！">{{$article->body ?? old('body')}}</textarea>
</div>