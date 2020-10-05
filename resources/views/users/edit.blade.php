@extends('app')

@section('title', 'ユーザー編集')

@section('content')
@include('nav')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-body pt-0">
                        @include('error_card_list')
                        <div class="card-text">
                            <form action="{{route('users.update', ['name' => $name])}}" method="post" enctype='multipart/form-data'>
                                @method('PUT')
                                @csrf
                                <div class="mt-3">
                                        <img src="{{ asset('storage/img/' . $user->image_path) }}" class="rounded-circle d-block mx-auto" width="50" height="50" id="thumbnail">
                                </div>
                                <div>
                                    <label for="thumbnail">プロフィール画像</label>
                                    <input type="file" name="image" class="d-block mx-auto">
                                </div>
                                <div class="mt-3">
                                    <label for="name">ユーザー名</label>
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                                </div>
                                <div class="py-4">
                                    <label for="users_profile">プロフィール</label>
                                    <textarea name="users_profile" id="users_profile" rows="4" class="form-control">{{$user->users_profile}}</textarea>
                                </div>
                                {{-- <input type="hidden" name="id" id="id" value="{{$user->id}}"> --}}
                                {{-- <input type="text" name="users_profile" id="users_profile" value="{{$user->users_profile}}" class="form-control"> --}}
                                <button type="submit" class="btn peach-gradient btn-block">更新する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection