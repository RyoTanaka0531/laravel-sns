@csrf
<div class="md-form">
    <label>タイトル</label>
    {{-- null合体演算子は 式1 ?? 式２ の形式で記述し、式1がnullでない場合、式1が結果となり、式1がnullの場合、式2が結果となる --}}
    <input type="text" name="title" class="form-control" required value="{{$article->title ?? old('title')}}">
</div>
<div class="form-group">
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
    <label></label>
    <textarea name="body" required class="form-control" row="16" placeholder="本文">{{$article->body ?? old('body')}}</textarea>
</div>