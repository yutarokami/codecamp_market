@extends('layouts.logged_in')
 
@section('content')
  <form action="{{ route('items.finish', $item) }}" method='get'>
    <div>
      <h2>商品名</h2>
      <p>{{ $item->name }}</p>
    </div>
    <div>
      <h2>画像</h2>
      <img src="{{ asset('storage/' . $item->image) }}">
    </div>
    <div>
      <h2>カテゴリ</h2>
      <p>{{ $category }}</p>
    </div>
    <div>
      <h2>価格</h2>
      <p>{{ $item->price }}</p>
    </div>
    <div>
      <h2>説明</h2>
      <p>{{ $item->description }}</p>
    </div>
    <input type=submit value=内容を確認し、購入する>
  </form>
@endsection