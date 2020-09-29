@extends('app')

@section('title', 'パスワード再設定')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <h1 class="text-center"><a class="text-dark" href="/">memo</a></h1>
                <div class="card mt-3">
                    <div class="card-body text-center">
                        <h2 class="h3 card-title text-center mt-2">パスワード再設定</h2>
                        @include('error_card_list')
                        @if (session('status'))
                            <div class="card-text alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                        <div class="card-text">
                            <form action="{{route('password.email')}}" method="post">
                                @csrf
                                <div class="md-form">
                                    <label for="email">メールアドレス</label>
                                    <input type="text" name="email" id="email" required class="form-control">
                                </div>
                                <button type="submit" class="btn btn-block blue-gradient mt-2 mb-2">メール送信</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection