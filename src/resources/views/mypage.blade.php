@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<script src="{{ asset('js/mypage_tabchange.js') }}"></script>
@endsection

@section('content')
<div class="mypage">
    <div class="mypage_top">
        <div class="mypage_top-image">
            <img class="mypage_top-image-item" src="{{ $url }}" alt="">
        </div>
        <div class="mypage_top-name">
            <span class="mypage_top-name-item">{{ $profile['name'] ?? '名前を設定してください' }}</span>
        </div>
        <div class="mypage_top-profile">
            <a href="/mypage/profile" class="mypage_top-profile-item">プロフィールを編集</a>
        </div>
    </div>
    <div class="mypage_main">
        <div class="mypage_main-top">
            <ul class="mypage_main-tab">
                <li class="mypage_main-list"><a href="#" class="mypage_main-list-item" onclick="showTab('tab1')" data-tab="tab1">出品した商品</a></li>
                <li class="mypage_main-list"><a href="#" class="mypage_main-list-item" onclick="showTab('tab2')" data-tab="tab2">購入した商品</a></li>
            </ul>
        </div>
        <?php $count1 = 0; ?>
        <div id="tab1" class="tab-content">
            @foreach ($item as $items)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $items['id'] ]) }}">
                    <input type="hidden" name="id" value="{{ $items['id'] }}"/>
                        <img src="{{ $items['image'] }}"  class="tab-content-image">
                    </button>
                </form>
            </div>
            <?php $count1 = $count1 + 1; ?>
            @endforeach
            <?php $number1 = $count1 % 4; ?>
            <div class="tab-box{{ $number1 }}"></div>
        </div>
        <?php $count2 = 0; ?>
        <div id="tab2" class="tab-content" style="display: none;">
            @foreach ($buy as $buys)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $buys['items_id'] ]) }}">
                    <input type="hidden" name="id" value="{{ $buys['items_id'] }}"/>
                        <img src="{{ $items['image'] }}"  class="tab-content-image">
                    </button>
                </form>
            </div>
            <?php $count2 = $count2 + 1; ?>
            @endforeach
            <?php $number2 = $count2 % 4; ?>
            <div class="tab-box{{ $number2 }}"></div>
        </div>
    </div>
</div>
@endsection