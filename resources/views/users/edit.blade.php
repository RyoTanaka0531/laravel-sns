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
                            <form action="{{route('users.update', ['name' => $name])}}" method="post">
                                @method('PUT')
                                @csrf
                                <thumbnail-area
                                :initial-uploadedImage='@json($user->thumbnail)'
                                >
                                </thumbnail-area>
                                {{-- <label for="thubmnail">プロフィール写真</label>
                                <img src="/storage/user/{{$user->thumbnail}}" class="thumbnail">
                                <input type="file" name="thumbnail" id="thumbnail"> --}}
                                {{-- <input type="hidden" name="id" id="id" value="{{$user->id}}"> --}}
                                <label for="name">ユーザー名</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                                <label for="profile">プロフィール</label>
                                <textarea name="profile" id="profile" rows="4" class="form-control">{{$user->profile}}</textarea>
                                {{-- <input type="text" name="profile" id="profile" value="{{$user->profile}}" class="form-control"> --}}
                                <button type="submit" class="btn peach-gradient btn-block">更新する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection