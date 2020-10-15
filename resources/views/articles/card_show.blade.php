<div class="card">
    @if ($article->deadline <= $now)
        <div class="card-body red-text">
            こちらの募集は締め切りました。
        </div>
    @elseif ($article->member === $article->count_joins)
        <div class="card-body red-text">
            こちらの募集は定員数に達成しました。
        </div>
    @endif
    <div class="card-body d-flex flex-row">
        <a href="{{route('users.show', ['name' => $article->user->name])}}" class="text-dark">
            @if ($article->user->image)
                <img src="{{ asset('storage/img/' . $article->user->image) }}" class="rounded-circle d-block mx-auto" width="50" height="50">
            @else
                <i class="fas fa-user-circle fa-3x"></i>
            @endif
        </a>
        <div>
            <div class="font-weight-bold">
                <a href="{{route('users.show', ['name' => $article->user->name])}}" class="text-dark">
                    {{$article->user->name}}
                </a>
            </div>
            <div class="font-weight-lighter">{{$article->created_at->format('Y/m/d H:i')}}</div>
        </div>
        @if (Auth::id() === $article->user_id)
            {{-- dropdown --}}
            <div class="ml-auto card-text">
                <div class="dropdown">
                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route("articles.edit", ['article' => $article])}}">
                            <i class="fas fa-pen mr-1"></i>記事を更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                        </a>
                    </div>
                </div>
            </div>
            {{-- dropdown --}}
            {{-- modal --}}
            <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                        @csrf
                        @method('DELETE')
                            <div class="modal-body">
                                {{ $article->title }}を削除します。よろしいですか？
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                <button type="submit" class="btn btn-danger">削除する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal -->
        @endif
    </div>
    <div class="card-body pt-0 pb-2">
        <h3 class="h4 card-title">
            <a class="text-dark" href="{{route('articles.show', ['article' => $article])}}">
                {{$article->title}}
            </a>
        </h3>
        <div class="card-body">
            <div class="card-text">
                <span>開催日時</span>
            </div>
            {{$article->date}}
        </div>
        <div class="card-body">
            <div class="card-text">
                <span>実施場所</span>
            </div>
            {{$article->area}}
            <div>
                @include('articles.map')
            </div>
        </div>
        <div class="card-body">
            <div class="card-text">
                <span>募集締め切り</span>
            </div>
            {{$article->deadline->format('Y年m月d日')}}まで
        </div>
        <div class="card-body">
            <div class="card-text">
                <span>参加費</span>
            </div>
            {{$article->fee}}
        </div>
        <div class="card-body">
            <div class="card-text">
                <span>主催者からのメッセージ</span>
            </div>
            {!! nl2br(e($article->body)) !!}
        </div>
    </div>
    <div class="card-body pt-0 pb-2 pl-3">
        <div class="card-text" style="display: inline-block">
            <article-like
            :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($article->count_likes)'
            :authorized='@json(Auth::check())'
            endpoint="{{route('articles.like', ['article' => $article])}}"
            >
            </article-like>
        </div>
        <div class="card-text" style="display: inline-block">
            <i class="fas fa-comment-dots mt-1 pr-2 pl-4 fa-2x" style="color: limegreen"></i>{{$article->comments->count()}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xs-2">
            <div class="card-body">
                <a href="{{route('articles.member', ['article' => $article])}}">
                    <i class="fas fa-user mr-1"></i>
                    {{$article->member}}人　現在 {{$article->count_joins}}人
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6"></div>
        <div class="col-lg-3 col-md-3 col-xs-2">
            <div class="card-text">
                <i class="fas fa-running text-primary"></i>
                <a href="{{route('genres.show', ['name' => $article->genre->name])}}">
                    {{$article->genre->name}}
                </a>
            </div>
            <div class="card-text">
                <i class="fas fa-map-marker-alt text-danger"></i>
                <a href="{{route('prefectures.show', ['name' => $article->prefecture->name])}}">
                    {{$article->prefecture->name}}
                </a>
            </div>
        </div>
    </div>
    @foreach ($article->tags as $tag)
        @if ($loop->first)
            <div class="card-body pt-0 pb-4 pl-3">
                <div class="card-text line-height">
        @endif
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                {{$tag->hashtag}}
            </a>
        @if ($loop->last)
                </div>
            </div>
        @endif
    @endforeach
    {{-- ゲストユーザーも参加ボタンは押せる状態。認証していない場合、押したらログイン画面に遷移 --}}
    <article-join
    :initial-is-joined-by='@json($article->isJoinedBy(Auth::user()))'
    :initial-count-joins='@json($article->count_joins)'
    :member='@json($article->member)'
    :authorized='@json(Auth::check())'
    endpoint="{{route('articles.join', ['article' => $article])}}"
    >
    </article-join>
</div>