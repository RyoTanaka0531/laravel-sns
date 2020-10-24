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
                                <div class="mt-3">
                                    <label for="age">年齢</label>
                                    <select name="age" id="age" class="form-control">
                                        @if(!empty($user->age))
                                            <option selected value="{{$user->age}}">{{$user->age}}</option>
                                        @elseif(!empty(old('age')))
                                            <option selected value="{{old('age')}}">{{old('age')}}</option>
                                        @else
                                            <option selected value="">選択して下さい</option>
                                        @endif
                                        @for ($i = 1; $i < 100; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                    {{-- <input type="text" name="age" id="age" value="{{$user->age ?? old('age')}}" class="form-control"> --}}
                                </div>
                                <div class="mt-3">
                                    <label for="sex">性別</label>
                                    <select name="sex" id="sex"class="form-control">
                                        @isset($user->sex)
                                            <option selected value="{{$user->sex}}">{{$user->sex}}</option>
                                        @else
                                            <option selected value="">選択して下さい</option>
                                        @endisset
                                        <option value="男性">男性</option>
                                        <option value="女性">女性</option>
                                    </select>
                                </div>
                                <label for="user_area" class="mt-3">活動地域</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select name="prefecture_id" id="prefecture_id" class="form-control">
                                            @isset($user->prefecture)
                                                <option selected value="{{$user->prefecture->id}}">{{$user->prefecture->name}}</option>
                                            @else
                                                <option selected value="">都道府県を選択して下さい</option>
                                            @endisset
                                            @foreach ($prefectures as $prefecture)
                                                <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                            <input type="text" name="address" id="address" value="{{$user->address ?? old('address')}}"
                                                    class="form-control" placeholder="例) 横浜市西区">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label for="genre_id">興味のあるスポーツ</label>
                                    <div>
                                        {{-- @foreach ($genres as $genre)
                                            <input type="checkbox" name="genre_id[]" value="{{$genre->id}}">
                                            <span class="mr-4">{{$genre->name}}</span>
                                        @endforeach --}}
                                        <select name="genre_id" id="genre_id" class="form-control">
                                            @isset ($user->genre)
                                                <option value="{{$user->genre->id}}">{{$user->genre->name}}</option>
                                            @else
                                                <option value="" selected>選択して下さい</option>
                                            @endisset
                                            @foreach ($genres as $genre)
                                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="py-4">
                                    <label for="prof">プロフィール</label>
                                    <textarea name="prof" id="prof" rows="4" class="form-control">{{$user->prof}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-block">更新する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection