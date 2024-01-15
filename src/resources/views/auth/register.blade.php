@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register" >
    <div class="register__title">
        <span>会員登録</span>
    </div>
    <div class="register__content">
        <form class="register-form" action="/register" method="post">
        @csrf
            <div class="register-form__item">
                <span>メールアドレス</span><br>
                <input class="register-form__input" type="text" name="email" value="{{ old('email') }}">
                <span class="error">{{$errors->first('email')}}</span>
            </div>
            <div class="register-form__item">
                <span>パスワード</span><br>
                <input class="register-form__input" type="password" name="password">
                <span class="error">{{$errors->first('password')}}</span>
            </div>
            <div class="register-form__button">
                <button class="register-form__button-submit" type="submit">登録する</button>
            </div>
        </form>
        <div class="login-here">
            <a href="/login">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection