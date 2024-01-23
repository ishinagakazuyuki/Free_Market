@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<script src="{{ asset('js/mypage_tabchange.js') }}"></script>
@endsection

@section('content')
<div class="mypage">
    <div class="mypage_top">
        <div class="mypage_top-image">
            <img class="mypage_top-image-item" src="{{ asset('storage/images/'.'1.jpg') ?? '' }}" alt="">
        </div>
        <div class="mypage_top-name">
            <span class="mypage_top-name-item">{{ $username['name'] }}</span>
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
        <?php $count = 0; ?>
        <div id="tab1" class="tab-content">
            @foreach ($item as $items)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $items['id'] ]) }}">
                        <img src="{{ asset('storage/images/'.$items['image']) }}"  class="tab-content-image">
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        <div id="tab2" class="tab-content" style="display: none;">
            @foreach ($buy as $buys)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $buys['items_id'] ]) }}">
                        <img src="{{ asset('storage/images/'.$buys['image']) }}"  class="tab-content-image">
                    </button>
                </form>
            </div>
            <?php $count = $count + 1; ?>
            @endforeach
            <?php $number = $count % 4; ?>
            <div class="tab-box{{ $number }}"></div>
        </div>
    </div>
</div>
@endsection