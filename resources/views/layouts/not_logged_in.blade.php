@extends('layouts.default')
 
@section('header')
<header>
  <h1>Cookcamp Market</h1>
  <ul class="header_nav">
    <li>
      <a href="{{ route('register') }}">
        ユーザー登録
      </a>
    </li>
    <li>
      <a href="{{ route('login') }}">
        ログイン
      </a>
    </li>
  </ul>
</header>
@endsection