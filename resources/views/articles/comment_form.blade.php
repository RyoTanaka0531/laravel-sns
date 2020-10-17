@auth
    <div class="card mt-3">
        <div class="card-body pt-0">
            <div class="card-text">
                <div class="md-form">
                    <form action="{{route('comment.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="article_id" value="{{$article->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <textarea name="message" id="message" cols="30" rows="4" class="form-control" placeholder="コメントを入力"></textarea>
                        <button type="submit" class="btn peach-gradient btn-block">コメントを投稿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endauth