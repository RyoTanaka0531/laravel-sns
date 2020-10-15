@extends('app')

@section('title', '記事詳細')

@section('content')
    @include('nav')
    @include('flash')
    @include('error_card_list')
    <div class="row">
        <div class="col-lg-3">
            @include('sidebar')
        </div>
        <div class="col-lg-9">
            <div class="container mt-3">
                @include('articles.card_show')
                @include('articles.tabs', ['hasArticles' => true, 'hasMembers' => false])
                {{-- <ul class="nav nav-tabs nav-justified mt-3">
                    <li class="nav-item">
                        <a class="nav-link text-muted active"
                        href="{{route('articles.show', ['article' => $article])}}">
                        コメント
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted"
                        href="{{route('articles.member', ['article' => $article])}}">
                        参加者
                        </a>
                    </li>
                </ul> --}}
                @foreach ($article->comments as $comment)
                    @include('articles.comment')
                @endforeach
                {{-- @include('articles.comment') --}}
                {{-- <div class="card-body">
                    <h4>
                        コメント一覧
                    </h4>
                </div>
                @foreach ($article->comments as $comment)
                    <div class="card mt-3">
                        <div class="card-body d-flex flex-row">
                            <a href="{{route('users.show', ['name' => $comment->user->name])}}" class="text-dark">
                                @if ($article->user->image)
                                <img src="{{ asset('storage/img/' . $comment->user->image) }}" class="rounded-circle d-block mx-auto" width="50" height="50" id="thumbnail">
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
                                <div class="font-weight-lighter ml-auto">{{$comment->created_at->format('Y/m/d H:i')}}</div>
                            </div>
                            <div>
                                <div class="card-body pt-0 pb-2">
                                    <div class="card-text">
                                        {{$comment->message}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row justify-content-center mt-3">
                    {{$article->comments->links()}}
                </div>
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
                @endauth --}}
            </div>
        </div>
    </div>
@endsection