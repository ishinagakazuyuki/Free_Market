@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <div class="purchase__left">
        <div class="purchase__left-top">
            <div class="purchase__left-left">
                <img class="purchase__left-img" src="{{ asset('storage/images/'.$item['image']) }}">
            </div>
            <div class="purchase__left-right">
                <p class="purchase__left-name">{{ $item['name'] }}</p>
                @php
                $value = number_format($item['value']);
                @endphp
                <p class="purchase__left-value">￥{{ $value }}</p>
            </div>
        </div>
        <div class="purchase__left-middle">
            <span class="purchase__left-title">支払い方法</span>
            <form action="?" method="get">
                <button class="purchase__left-change" type="submit" value="get" formaction="{{ route('purchase.payment',['item_id' => $item['id'] ]) }}">
                    変更する</button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </form>
        </div>
        <div class="purchase__left-payment">
            <span>　{{ $payment }}</span>
        </div>
        <div class="purchase__left-bottom">
            <span class="purchase__left-title">配送先</span>
            <form action="?" method="get">
                <button class="purchase__left-change" type="submit" value="get" formaction="{{ route('purchase.address',['item_id' => $item['id'] ]) }}">
                    変更する</button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
                <input type="hidden" name="payment" value="{{ $payment }}"/>
            </form>
        </div>
        <div class="purchase__left-address">
            <p>　　〒：{{ $profile['post_code'] }}</p>
            <p>　住所：{{ $profile['address'] }}</p>
            @if (!empty($profile['building']))
            <p>　建物：{{ $profile['building'] }}</p>
            @endif
        </div>
    </div>
    <div class="purchase__right">
        <form action="/sold" method="post">
        @csrf
            <div class="purchase__right-info">
                <div class="purchase__right-top">
                    <span class="purchase__right-item">商品代金</span>
                    @php
                    $value = number_format($item['value']);
                    @endphp
                    <span>￥{{ $value }}</span>
                </div>
                <div class="purchase__right-middle">
                    <span class="purchase__right-item">支払い金額</span>
                    <span>￥{{ $value }}</span>
                </div>
                <div class="purchase__right-bottom">
                    <span class="purchase__right-item">支払い方法</span>
                    <span name="payment">{{ $payment }}</span>
                </div>
            </div>
            <div class="purchase__button">
                <button class="purchase__button-item" type="submit">購入する</button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </div>
        </form>
    </div>
</div>
@endsection