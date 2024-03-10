@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail">
    <div class="detail__image">
        <img class="detail__image-item" src="{{ $item['image'] }}" alt="">
    </div>
    <div class="detail__main">
        <div class="detail__title">
            <span class="detail__name">{{ $item['name'] }}</span><br>
            <span>{{ $brand['name'] }}</span>
        </div>
        <div class="detail__value">
            @php
            $value = number_format($item['value']);
            @endphp
            <span class="detail__value-item">￥{{ $value }}（値段）</span>
        </div>
        <div class="detail__item">
            <div class="detail__favorite">
                <form action="?" method="post">
                @csrf
                    <button class="detail__favorite-button" type="submit" value="post" formaction="/favorite">☆</button><br>
                    <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                    <span class="detail__favorite-count">{{ $favorite }}</span>
                </form>
            </div>
            <div class="detail__comment">
                <form action="?" method="get">
                    <button class="detail__comment-button" type="submit" value="get" formaction="/comment">💬</button><br>
                    <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                    <span class="detail__comment-count">{{ $comment }}</span>
                </form>
            </div>
        </div>
        <div class="detail__buy" >
            <form action="?" method="get">
                <button id="buy" class="detail__buy-button" type="submit" value="get" formaction="{{ route('purchase',['item_id' => $item['id'] ]) }}">
                    購入する
                </button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </form>
        </div>
        <div class="detail__description">
            <p class="detail__description-title">商品説明</p>
            <textarea class="detail__description-item" readonly>{{ $item['description'] }}</textarea>
        </div>
        <div class="detail__info">
            <p class="detail__info-title">商品の情報</p>
            <div class="detail__info-category">
                <span class="detail__info-category-item">カテゴリー</span>
                <span class="detail__info-category-item2">{{ $category['first'] }}</span>
                <span class="detail__info-category-item2">{{ $category['second'] }}</span>
            </div>
            <div class="detail__condition">
                <span class="detail__condition-item">状態</span>
                <span class="detail__condition-item2">{{ $condition['name'] }}</span>
            </div>
        </div>
    </div>
</div>
@endsection