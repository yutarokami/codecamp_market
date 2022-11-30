@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="/">
            トップページ
          </a>
        </li>
        <li>
          こんにちは、test2さん！
        </li>
        <li>
          <a href="{{ route('users.show') }}">
            プロフィール
          </a>
        </li>
        <li>
          <a href="{{ route('likes.index') }}">
            お気に入り一覧
          </a>
        </li>
        <li>
          <a href="{{ route('users.exhibitions') }}">
            出品商品一覧
          </a>
        </li>
        <li>ログアウト</li>
    </ul>
</header>
@endsection