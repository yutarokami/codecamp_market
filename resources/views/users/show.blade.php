@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <div>
    @if( $user->image!=='')
      <img src="{{ asset('storage/' . $user->image) }}">
    @else
      <img src="{{ asset('images/no_image.png') }}">
    @endif
    <a href="{{ route('profile.edit_image') }}">画像を変更</a>
  </div>
  
  <div>
    <p>{{ $user->name }} さん</p>
    <a href="{{ route('profile.edit') }}">プロフィールを編集</a>
  </div>
  
  <p>{{ $user->profile }}</p>
  
  <p>出品数: {{ $item_amount }}</p>
  <h2>購入履歴</h2>
  <div>
      @forelse($order_items as $order_item)
        <a href="{{ route('items.show', $order_item) }}">{{ $order_item->name }}</a>:
        {{ $order_item->price }}円 出品者 {{ $order_item->name }}さん
      @empty
        <p>購入した商品はありません。</p>
      @endforelse
  </div>
@endsection