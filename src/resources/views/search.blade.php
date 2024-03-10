@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<script src="{{ asset('js/search_tabchange.js') }}"></script>
@endsection

@section('content')
<div class="search">
    <div class="search_result">
        <span>{{ $message }}</span>
    </div>
    <div class="search_main">
        <?php $count = 0; ?>
        <div class="tab-content">
            @if (!empty($item))
            @foreach ($item as $items)
            <div class="tab-content-item">
                <form action="?" method="get">
                    <button class="tab-content-button" type="submit" value="get" formaction="{{ route('detail',['item_id' => $items['id'] ]) }}">
                    <input type="hidden" name="id" value="{{ $items['id'] }}"/>
                        <img src="{{ $items['image'] }}"  class="tab-content-image">
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