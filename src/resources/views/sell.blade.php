@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell" >
    <div class="sell__title">
        <span>商品の出品</span>
    </div>
    <div class="sell__content">
        <form class="sell-form" action="/sell" method="post" enctype="multipart/form-data">
        @csrf
            <div class="sell-form__item">
                <label class="sell-form__buttonn">
                    <input class="sell-form__img-button" type="file" name="image">画像を選択する
                </label><br>
                <span class="error">{{$errors->first('image')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品の詳細（下線を付ける）</span><br>
            </div>
            <div class="sell-form__item">
                <span>カテゴリー（選択リストを作る）</span><br>
                <input class="sell-form__input" type="text" name="name" value="">
                <span class="error">{{$errors->first('name')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品の状態（これも選択リスト）</span><br>
                <input class="sell-form__input" type="text" name="post_code" value="">
                <span class="error">{{$errors->first('post_code')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品名と説明（下線を付ける）</span><br>
            </div>
            <div class="sell-form__item">
                <span>商品名</span><br>
                <input class="sell-form__input" type="text" name="address" value="">
                <span class="error">{{$errors->first('address')}}</span>
            </div>
            <div class="sell-form__item">
                <span>ブランド（選択リストを作る）</span><br>
                <input class="sell-form__input" type="text" name="address" value="">
                <span class="error">{{$errors->first('address')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品の説明（テキストエリア）</span><br>
                <input class="sell-form__input" type="text" name="building" value="">
            </div>
            <div class="sell-form__item">
                <span>販売価格（下線を付ける）</span><br>
            </div>
            <div class="sell-form__item">
                <span>販売価格</span><br>
                <input class="sell-form__input" type="text" name="address" value="">
                <span class="error">{{$errors->first('address')}}</span>
            </div>
            <div class="sell-form__button">
                <button class="sell-form__button-submit" type="submit">出品する</button>
            </div>
        </form>
    </div>
</div>
@endsection