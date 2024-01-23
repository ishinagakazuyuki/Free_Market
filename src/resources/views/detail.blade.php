@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks_message">
        <span>詳細ページだよ</span>
    </div>
    <div class="login-guidance">
        <a href="/login" class=login-guidance__link>ログインする</a>
    </div>
</div>
@endsection