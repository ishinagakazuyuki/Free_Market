@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address" >
    <div class="address__title">
        <span>住所の変更</span>
    </div>
    <div class="address__content">
        <form class="address-form" action="{{ route('purchase.address_update',['item_id' => $item['id'] ]) }}" method="post">
        @csrf
            <div class="address-form__item">
                <span>郵便番号</span><br>
                <input class="address-form__input" type="text" name="post_code" value="{{ $profile['post_code'] ?? '' }}">
                <span class="error">{{$errors->first('post_code')}}</span>
            </div>
            <div class="address-form__item">
                <span>住所</span><br>
                <input class="address-form__input" type="text" name="address" value="{{ $profile['address'] ?? '' }}">
                <span class="error">{{$errors->first('address')}}</span>
            </div>
            <div class="address-form__item">
                <span>建物名</span><br>
                <input class="address-form__input" type="text" name="building" value="{{ $profile['building'] ?? '' }}">
            </div>
            <div class="address-form__button">
                <button class="address-form__button-submit" type="submit">更新する</button>
                <input type="hidden" name="payment" value="{{ $payment }}"/>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </div>
        </form>
    </div>
</div>
@endsection