@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <p>商品名: {{$name}} </p>
  <p>商品説明: {{$description}} </p>
  <p>価格: {{$price}} </p>
  <p>カテゴリー: {{$category}} </p>
@endsection