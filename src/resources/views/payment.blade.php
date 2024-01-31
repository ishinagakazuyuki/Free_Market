@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="payment" >
    <div class="payment__title">
        <span>支払い方法の変更</span>
    </div>
    <div class="payment__content">
        <form class="payment-form" action="{{ route('purchase.payment_update',['item_id' => $item['id'] ]) }}" method="post">
        @csrf
            <input type="radio" id="1" name="payment" value="コンビニ支払い">
            <label class="payment-form__item" for="1">コンビニ支払い</label><br>
            <input type="radio" id="2" name="payment" value="クレジットカード払い">
            <label class="payment-form__item" for="2">クレジットカード払い</label><br>
            <input type="radio" id="3" name="payment" value="銀行振込">
            <label class="payment-form__item" for="3">銀行振込</label><br>
            <div class="payment-form__button">
                <button class="payment-form__button-submit" type="submit">更新する</button>
                <input type="hidden" name="id" value="{{ $item['id'] }}"/>
            </div>
        </form>
    </div>
</div>
@endsection