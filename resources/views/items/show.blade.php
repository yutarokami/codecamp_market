@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <div>
    <h2>商品名</h2>
    <p>{{ $name }}</p>
  </div>
  <div>
    <h2>画像</h2>
    <img src="{{ asset('storage/' . $image) }}">
  </div>
  <div>
    <h2>カテゴリ</h2>
    <p>{{ $category }}</p>
  </div>
  <div>
    <h2>価格</h2>
    <p>{{ $price }}</p>
  </div>
  <div>
    <h2>説明</h2>
    <p>{{ $description }}</p>
  </div>
  <input type=submit value=購入する>
@endsection