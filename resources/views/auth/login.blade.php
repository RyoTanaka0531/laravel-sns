@extends('app')
@section('title', 'ログイン')

@section('content')
@include('nav')
    <div class="container">
        <div class="row mt-3">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <h1 class="text-center"><a class="text-dark" href="/">sports</a></h1>
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <h2 class="h3 card-title text-center mt-2">ログイン</h2>
                        <a href="{{route('login.{provider}', ['provider' => 'google'])}}" class="btn btn-block btn-success">
                            <i class="fab fa-google mr-1"></i>Googleでログイン
                        </a>
                        @include('error_card_list')
                        <div class="card-text">
                            <form action="{{route('login')}}" method="post">
                            @csrf
                                <div class="md-form">
                                    <label for="email">メールアドレス</label>
                                    <input type="text" name="email" id="email" required value="{{old('email')}}" class="form-control">
                                </div>
                                <div cladd="md-form">
                                    <label for="password">パスワード</label>
                                    <input type="password" name="password" id="password" required value="{{old('password')}}" class="form-control">
                                </div>
                                <input type="hidden" name="remember" id="remember" value="on">
                                <div class="text-left">
                                    <a href="{{route('password.request')}}" class="card-text">パスワードを忘れた方</a>
                                </div>
                                <button type="submit" class="btn btn-block blue-gradient mt-2 mb-2">ログイン</button>
                            </form>
                            <div class="mt-o">
                                <a href="{{route('register')}}" class="card-text">ユーザー登録はこちら</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection