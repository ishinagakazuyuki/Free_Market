@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="login__title">
        <span>ログイン</span>
    </div>
    <div class="login__content">
        <form class="login-form" action="/login" method="post">
        @csrf
            <div class="login-form__item">
                <span>メールアドレス</span><br>
                <input class="login-form__input" type="text" name="email" value="{{ old('email') }}" >
                <span class="error">{{$errors->first('email')}}</span>
            </div>
            <div class="login-form__item">
                <span>パスワード</span><br>
                <input class="login-form__input" type="password" name="password">
                <span class="error">{{$errors->first('password')}}</span>
            </div>
            <div class="login-form__button">
                <button class="login-form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
        <div class="register-here">
            <a href="/register">会員登録はこちら</a>
        </div>
    </div>
</div>
@endsection