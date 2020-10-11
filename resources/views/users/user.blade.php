<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex flex-row">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            @if ($user->image)
                <img src="{{ asset('storage/img/' . $user->image) }}" class="rounded-circle d-block mx-auto" width="50" height="50" id="thumbnail">
            @else
                <i class="fas fa-user-circle fa-3x"></i>
            @endif
        </a>
        @if( Auth::id() !== $user->id )
            <follow-button
            class="ml-auto"
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            endpoint="{{route('users.follow', ['name' => $user->name])}}"
            >
            </follow-button>
        @endif
        @if (Auth::id() === $user->id)
            <button type="button" class="ml-auto btn btn-primary p-2">
                <a class="text-white" href="{{route('users.edit', ['name' => $user->name])}}">
                    編集する
                </a>
            </button>
        @endif
        </div>
        <h2 class="h5 card-title m-0">
        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
            {{ $user->name }}
        </a>
        </h2>
    </div>
    <div class="card-body">
        <div class="card-text">
            自己紹介
        </div>
        {{$user->prof}}
    </div>
    <div class="card-body">
        <div class="card-text mr-3" style="display: inline-block">
            年齢
        </div>
        <div style="display: inline-block">
            {{$user->age}}歳
        </div>
    </div>
    <div class="card-body">
        <div class="card-text mr-3" style="display: inline-block">
            性別
        </div>
        <div style="display: inline-block">
            {{$user->sex}}
        </div>
    </div>
    <div class="card-body">
        <div class="card-text mr-3" style="display: inline-block">
            活動地域
        </div>
        <div style="display: inline-block">
            @if($user->user_area)
                {{$user->user_area}}
            @elseif($user->prefecture !== null)
                {{$user->address}}
            @elseif($user->address !== null)
                {{$user->prefecture->name}}
            @else
                未設定
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="card-text mr-3" style="display: inline-block">
            興味のあるスポーツ
        </div>
        <div style="display: inline-block">
            {{-- 多対多の関係を定義する場合 --}}
            {{-- @foreach($user->genres as $genre)
                @if($loop->first)
                    <div class="card-body pt-0 pb-4 pl-3">
                    <div class="card-text line-height">
                @endif
                    {{ $genre->name }}
                @if($loop->last)
                    </div>
                    </div>
                @endif
            @endforeach --}}
                {{$user->genre->name}}
    </div>
    <div class="card-body">
        <div class="card-text">
            <a href="{{route('users.followings', ['name' => $user->name])}}" class="text-muted">
                {{$user->count_followings}}フォロー
            </a>
            <a href="{{route('users.followers', ['name' => $user->name])}}" class="text-muted">
                {{$user->count_followers}}フォロワー
            </a>
        </div>
    </div>
</div>