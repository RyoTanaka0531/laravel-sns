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
                                    @if ($user->image)
                                        <img src="{{ asset('storage/img/' . $user->image) }}" class="rounded-circle d-block mx-auto" width="50" height="50">
                                    @else
                                        <i class="fas fa-user-circle fa-3x"></i>
                                    @endif
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
                                    <label for="prof">プロフィール</label>
                                    <textarea name="prof" id="prof" rows="4" class="form-control">{{$user->prof}}</textarea>
                                </div>
                                {{-- <input type="hidden" name="id" id="id" value="{{$user->id}}"> --}}
                                {{-- <input type="text" name="prof" id="prof" value="{{$user->prof}}" class="form-control"> --}}
                                <button type="submit" class="btn peach-gradient btn-block">更新する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection