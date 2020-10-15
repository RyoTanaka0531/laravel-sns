<ul class="nav nav-tabs nav-justified mt-3">
    <li class="nav-item">
        <a class="nav-link text-muted {{$hasArticles ? 'active' : ''}}"
        href="{{route('articles.show', ['article' => $article])}}">
        コメント
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-muted {{$hasMembers ? 'active' : ''}}"
        href="{{route('articles.member', ['article' => $article])}}">
        参加者
        </a>
    </li>
</ul>