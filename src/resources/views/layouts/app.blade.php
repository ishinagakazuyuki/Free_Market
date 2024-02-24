<!DOCTYPE html>
<html lang="ja">
<style>
    svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 20px;
    }
</style>
<?php
$env = env('APP_ENV');
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free_Marcket</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  @yield('css')
</head>

<body class="body">
  <header class="header">
    <div class="header__logo">
      @if($env == 'local')
      <img class="header__logo-left" src="{{ asset('storage/images/logo_img.svg') }}" alt="">
      <img class="header__logo-right" src="{{ asset('storage/images/coachtech_img.png') }}" alt="">
      @else
      <img class="header__logo-left" src="https://ishikazu.s3.ap-northeast-1.amazonaws.com/public/images//logo_img.svg" alt="">
      <img class="header__logo-right" src="https://ishikazu.s3.ap-northeast-1.amazonaws.com/public/images/coachtech_img.png" alt="">
      @endif
    </div>
    @if ($menu_flg == '1')
    <div class="header__search">
      <input class="header__search-item" type="text" placeholder=" なにをお探しですか？">
    </div>
    @if (Auth::check())
    <div class="header__logout">
      <form class="menu-logout" action="/logout" method="post">
      @csrf
        <button class="header__logout-item">ログアウト</button>
      </form>
    </div>
    <div class="header__mypage">
      <a class="header__mypage-item" href="/mypage">マイページ</a>
    </div>
    @else
    <div class="header__login">
      <a class="header__login-item" href="/login">ログイン</a>
    </div>
    <div class="header__register">
      <a class="header__register-item" href="/register">会員登録</a>
    </div>
    @endif
    <div class="header__sell">
      <a class="header__sell-item" href="/sell">出品</a>
    </div>
    @endif
  </header>

  <main>
    <div class="main" >
    @yield('content')
    </div>
  </main>
</body>
</html>