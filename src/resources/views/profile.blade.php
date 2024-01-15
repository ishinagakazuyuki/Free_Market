@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="register" >
    <div class="register__title">
        <span>プロフィール設定</span>
    </div>
    <div class="register__content">
        <form class="register-form" action="/mypage/profile" method="post" enctype="multipart/form-data">
        @csrf
            <div class="register-form__item">
                <img class="register-form__img" src="{{ asset('storage/images/'.$profile['image']) ?? '' }}" alt="">
                <label class="register-form__buttonn">
                    <input class="register-form__img-button" type="file" name="image">画像を選択する
                </label><br>
                <span class="error">{{$errors->first('image')}}</span>
            </div>
            <div class="register-form__item">
                <span>ユーザー名</span><br>
                <input class="register-form__input" type="text" name="name" value="{{ $profile['name'] ?? '' }}">
                <span class="error">{{$errors->first('name')}}</span>
            </div>
            <div class="register-form__item">
                <span>郵便番号</span><br>
                <input class="register-form__input" type="text" name="post_code" value="{{ $profile['post_code'] ?? '' }}">
                <span class="error">{{$errors->first('post_code')}}</span>
            </div>
            <div class="register-form__item">
                <span>住所</span><br>
                <input class="register-form__input" type="text" name="address" value="{{ $profile['address'] ?? '' }}">
                <span class="error">{{$errors->first('address')}}</span>
            </div>
            <div class="register-form__item">
                <span>建物名</span><br>
                <input class="register-form__input" type="text" name="building" value="{{ $profile['building'] ?? '' }}">
            </div>
            <div class="register-form__button">
                <button class="register-form__button-submit" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection