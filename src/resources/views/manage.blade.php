@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('content')
<div class="manage" >
    <div class="manage__title">
        <span>管理画面</span>
    </div>
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
@endsection