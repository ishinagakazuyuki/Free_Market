@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
<script src="{{ asset('js/category_select.js') }}"></script>
<script src="{{ asset('js/condition_select.js') }}"></script>
<script src="{{ asset('js/brand_select.js') }}"></script>
<script src="{{ asset('js/value_parts.js') }}"></script>
@endsection

@section('content')
<div class="sell" >
    <div class="sell__title">
        <span>商品の出品</span>
    </div>
    <div class="sell__content">
        <form class="sell-form" action="/sell" method="post" enctype="multipart/form-data">
        @csrf
            <div class="sell-form__img">
                <label class="sell-form__buttonn">
                    <input class="sell-form__img-button" type="file" name="image" value="{{ old('image') }}">画像を選択する
                </label>
                <span class="error">{{$errors->first('image')}}</span>
            </div>
            <div class="sell-form__item2">
                <span>商品の詳細</span><br>
            </div>
            <div class="sell-form__item">
                <span>カテゴリー</span><br>
                <select id="category_select" class="sell-form__select" name="category" onchange="showHideInput_category()">
                    <option value="">選んでね</option>
                    @foreach($category as $categories)
                    <option value="{{ $categories['id'] }}" {{ old('category') == $categories['id'] ? 'selected' : '' }}>
                        {{ $categories['first'].':'.$categories['second']}}</option>
                    @endforeach
                    <option value="another" {{ old('category') == 'another' ? 'selected' : '' }}>その他</option>
                </select>
                <span class="error">{{$errors->first('category')}}</span>
            </div>
            <div id="category_input" class="sell-form__item another_input" style="display:{{ old('category') == 'another' ? 'block' : 'none' }}">
                <label for="additionalInput">カテゴリ（種類）を入力してください</label><br>
                <input class="sell-form__input" type="text" id="additionalInput" name="new_first"><br>
                <span class="error">{{$errors->first('new_first')}}</span><br><br>
                <label for="additionalInput">カテゴリ（用途）を入力してください</label><br>
                <input class="sell-form__input" type="text" id="additionalInput" name="new_second">
                <span class="error">{{$errors->first('new_second')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品の状態</span><br>
                <select id="condition_select" class="sell-form__select" name="condition" onchange="showHideInput_condition()">
                    <option value="">選んでね</option>
                    @foreach($condition as $conditions)
                    <option value="{{ $conditions['id'] }}" {{ old('condition') == $conditions['id'] ? 'selected' : '' }}>{{ $conditions['name']}}</option>
                    @endforeach
                    <option value="another" {{ old('category') == 'another' ? 'selected' : '' }}>その他</option>
                </select>
                <span class="error">{{$errors->first('condition')}}</span>
            </div>
            <div id="condition_input" class="sell-form__item another_input" style="display:{{ old('category') == 'another' ? 'block' : 'none' }}">
                <label for="additionalInput">商品の状態を入力してください</label><br>
                <input class="sell-form__input" type="text" id="additionalInput" name="new_condition">
                <span class="error">{{$errors->first('new_condition')}}</span>
            </div>
            <div class="sell-form__item2">
                <span>商品名と説明</span><br>
            </div>
            <div class="sell-form__item">
                <span>商品名</span><br>
                <input class="sell-form__input" type="text" name="name" value="{{ old('name') }}">
                <span class="error">{{$errors->first('name')}}</span>
            </div>
            <div class="sell-form__item">
                <span>ブランド</span><br>
                <select id="brand_select" class="sell-form__select" name="brand" onchange="showHideInput_brand()">
                    <option value="">選んでね</option>
                    @foreach($brand as $brands)
                    <option value="{{ $brands['id'] }}" {{ old('brand') == $brands['id'] ? 'selected' : '' }}>{{ $brands['name']}}</option>
                    @endforeach
                    <option value="another" {{ old('category') == 'another' ? 'selected' : '' }}>その他</option>
                </select>
                <span class="error">{{$errors->first('brand')}}</span>
            </div>
            <div id="brand_input" class="sell-form__item another_input" style="display:{{ old('category') == 'another' ? 'block' : 'none' }}">
                <label for="additionalInput">ブランドを入力してください</label><br>
                <input class="sell-form__input" type="text" id="additionalInput" name="new_brand">
                <span class="error">{{$errors->first('new_brand')}}</span>
            </div>
            <div class="sell-form__item">
                <span>商品の説明</span><br>
                <textarea class="sell-form__textarea" name="description" id="" rows="3">{{ old('description') }}</textarea>
                <span class="error">{{$errors->first('description')}}</span>
            </div>
            <div class="sell-form__item2">
                <span>販売価格</span><br>
            </div>
            <div class="sell-form__item value_item">
                <span>販売価格</span><br>
                <input id="myInput" class="sell-form__input value_input" type="text" name="value" value="{{ old('value') }}">
                <span class="error">{{$errors->first('value')}}</span>
            </div>
            <div class="sell-form__button">
                <button class="sell-form__button-submit" type="submit">出品する</button>
            </div>
        </form>
    </div>
</div>
@endsection