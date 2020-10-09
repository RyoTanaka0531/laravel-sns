<div class="card mt-3">
    <div class="card-head mt-3">
        <h4>
            <i class="fas fa-running fa-2x pl-3"></i>　スポーツ一覧
        </h4>
    </div>
    <div class="card-body">
        @foreach ($genres as $genre)
            <ul style="list-style-type:none;">
                <li>
                    <a href="{{route('genres.show', ['name' => $genre->name])}}">
                        {{$genre->name}} ({{$genre->articles->count()}})
                    </a>
                </li>
            </ul>
        @endforeach
    </div>
</div>