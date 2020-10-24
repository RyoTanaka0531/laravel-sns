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
<div class="row justify-content-center mt-3">
    {{$article->comments->links()}}
</div>