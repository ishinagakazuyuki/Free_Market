@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks_message">
        <span>マイページダヨーン</span>
    </div>
    <div class="thanks_message">
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
@endsection