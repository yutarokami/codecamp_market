@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <div>
    <a href="items/create">
      新規出品
    </a>
  </div>
  <div>
    @forelse($items as $item)
      @if($item->image !== '')
        <img src="{{ asset('storage/' . $item->image) }}">
      @else
        <img src="{{ asset('images/no_image.png') }}">
      @endif
      <a href="{{ route('items.edit', $item) }}">編集</a>
      <a href="{{ route('items.edit_image', $item) }}">画像を変更</a>
      
      <p>商品名:{{ $item->name }}</p>
      <p>{{ $item->price }} 円</p>
      <p>カテゴリ:{{ $item->category_id }} {{ $item->created_at }}</p>
    @empty
      <p>出品している商品はありません。</p>
    @endforelse
  </div>
@endsection