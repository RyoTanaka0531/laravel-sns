<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex flex-row">
            <a href="{{route('users.show', ['name' => $person->name])}}" class="text-dark">
                @if ($person->image)
                    <img src="{{ asset('storage/img/' . $person->image) }}" class="rounded-circle d-block mx-auto" width="50" height="50" id="thumbnail">
                @else
                    <i class="fas fa-user-circle fa-3x"></i>
                @endif
            </a>
            @if (Auth::id() !== $person->id)
                <follow-button
                class="ml-auto"
                :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
                :authorized='@json(Auth::check())'
                endpoint="{{route('users.follow', ['name' => $person->name])}}"
                ></follow-button>
            @endif
        </div>
        <h2 class="h5 card-title m-0">
            <a href="{{route('users.show', ['name' => $person->name])}}" class="text-dark">
                {{$person->name}}
            </a>
        </h2>
    </div>
</div>