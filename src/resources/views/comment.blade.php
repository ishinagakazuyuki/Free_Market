@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/comment.css') }}">
@endsection

@section('content')
<div class="comment">
    <div class="comment__image">
        <img class="comment__image-item" src="{{ $item['image'] }}" alt="">
    </div>
    <div class="comment__main">
        <div class="comment__title">
            <span class="comment__name">{{ $item['name'] }}</span><br>
            <span>{{ $brand['name'] }}</span>
        </div>
        <div class="comment__value">
            @php
            $value = number_format($item['value']);
            @endphp
            <span class="comment__value-item">￥{{ $value }}（値段）</span>
        </div>
        <div class="comment__item">
            <div class="comment__favorite">
                <form action="?" method="post">
                @csrf
                    <button class="comment__favorite-button" type="submit" value="post" formaction="/comment/favorite">☆</button><br>
                    <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                    <span class="comment__favorite-count">{{ $favorite }}</span>
                </form>
            </div>
            <div class="comment__comment">
                <form action="?" method="get">
                    <button class="comment__comment-button" type="submit" value="get" formaction="/comment">💬</button><br>
                    <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                    <span class="comment__comment-count">{{ $comment }}</span>
                </form>
            </div>
        </div>
        <div class="comment__list">
            @if (!empty($user))
            @foreach($user as $users)
            <div class="comment__list-user {{ $users->user_id === Auth::user()->id ? 'left-margin' : '' }}">
                <div class="comment__list-item">
                    <img class="comment__user-image" src="{{ $users['image'] }}" alt="">
                </div>
                <div class="comment__list-item2">
                    <span class="comment__user-name">{{ $users['name'] }}</span>
                </div>
            </div>
            <div class="comment__list-comment">
                <p class="comment__list-comment-item">{{ $users['comment'] }}</p>
            </div>
            @if ($users['id'] == $own['id'] || !empty($permission) )
            <div class="comment__delete">
                <form action="?" method="post">
                @csrf
                    <button class="comment__delete-button" type="submit" value="post" formaction="/comment/delete">コメントを削除する</button>
                    <input type="hidden" name="comment_id" value="{{ $users['id'] }}"/>
                    <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                </form>
            </div>
            @endif
            @endforeach
            @endif
        </div>
        <div class="comment__write">
            <form action="?" method="post">
            @csrf
                <span class="comment__write-title">商品へのコメント</span><br>
                <textarea name="comment" class="comment__write-comment" cols="52" rows="10"></textarea><br>
                <span class="error">{{$errors->first('comment')}}</span><br>
                <button class="comment__write-button" type="submit" value="post" formaction="/comment">コメントを送信する</button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </form>
        </div>
    </div>
</div>
@endsection