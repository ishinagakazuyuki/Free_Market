@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('content')
<div class="manage" >
    <div class="manage__title">
        <span>管理画面</span>
    </div>
    <div class="manage__main">
        <div class="manage__right">
            <div class="manage__header" >
                <span class="manage__header-item">ユーザ名</span>
                <span class="manage__header-item">メールアドレス</span>
                <span class="manage__header-item"></span>
            </div>
            @foreach($users as $user)
            <div class="manage__content">
                <span class="manage__header-item">{{ $user['name'] }}</span>
                <span class="manage__header-item">{{ $user['email'] }}</span>
                <form class="manage-form" action="/manage/delete" method="post">
                @csrf
                    <div class="manage-form__button">
                        <button class="manage-form__button-submit" type="submit">削除する</button>
                        <input type="hidden" name="id" value="{{ $user['user_id'] }}"/>
                    </div>
                </form>
            </div>
            @endforeach
            {{ $users->links('vendor.pagination.tailwind3') }}
        </div>
        <div class="manage__left">
            <span class="manage__mail-title">メール送信入力フォーム</span>
            <form class="manage__mail-form" action="/manage/send" method="post">
            @csrf
                <label class="manage__mail-label" for="">メール件名</label><br>
                <input class="manage__mail-input" type="text" name="title" value=""><br>
                <span class="error">{{$errors->first('title')}}</span><br>
                <label class="manage__mail-label" for="">メールアドレス</label><br>
                <input class="manage__mail-input" type="text" name="address" value=""><br>
                <span>※未入力の場合は利用者全員にメールが送信されます</span><br>
                <label class="manage__mail-label" for="">メール本文</label><br>
                <textarea class="manage__mail-textarea" name="text" id="" cols="30" rows="10"></textarea><br>
                <span class="error">{{$errors->first('text')}}</span>
                <div>
                    <button class="manage__mail-button" type="submit">メールを送信する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection