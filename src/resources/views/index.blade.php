@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="{{ asset('js/index_tabchange.js') }}"></script>
@endsection

@section('content')
<div class="index">
    <div class="index_main">
        <div class="index_main-top">
            <ul class="index_main-tab">
                <li class="index_main-list"><a href="#" class="index_main-list-item" onclick="showTab('tab1')" data-tab="tab1">おすすめ</a></li>
                <li class="index_main-list"><a href="#" class="index_main-list-item" onclick="showTab('tab2')" data-tab="tab2">マイリスト</a></li>
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
            @if ($mylist === null)
            <div></div>
            @else
            @foreach ($mylist as $mylists)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $mylists['id'] ]) }}">
                        <img src="{{ asset('storage/images/'.$mylists['image']) }}"  class="tab-content-image">
                    </button>
                </form>
            </div>
            <?php $count = $count + 1; ?>
            @endforeach
            <?php $number = $count % 5; ?>
            <div class="tab-box{{ $number }}"></div>
            @endif
        </div>
    </div>
</div>
@endsection