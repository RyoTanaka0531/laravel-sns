<nav class="navbar navbar-expand">
    <a class="navbar-brand" href="/"><i class="fas fa-running mr-2"></i>スポコミュ</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-items">
            <form action="{{route('articles.search')}}" method="post">
                @csrf
                @method('GET')
                <div class="input-group mb-2">
                    <input type="text" name="keyword" class="form-control" placeholder="キーワード">
                        <div class="input-group-append" style="background-color:white;">
                            <button type="submit" class="input-group-text" value="検索">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                </div>
            </form>
        </li>
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">ユーザー登録</a>
            </li>
        @endguest
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">ログイン</a>
            </li>
        @endguest
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{route('articles.create')}}"><i class="fas fa-pen mr-1"></i>募集する</a>
            </li>
        @endauth

        @auth
            {{-- Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <button class="dropdown-item" type="button" onclick="location.href='{{route('users.show', ['name' => Auth::user()->name])}}'">
                        マイページ
                    </button>
                    <div class="dropdown-divider"></div>
                    <button form="logout-button" class="dropdown-item" type="submit">
                        ログアウト
                    </button>
                </div>
            </li>
            <form action="{{route('logout')}}" id="logout-button" method="POST">
                @csrf
            </form>
            {{-- Dropdown --}}
        @endauth
    </ul>
</nav>