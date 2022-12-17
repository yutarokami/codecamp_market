@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  @forelse($items as $item)
    <a href="{{ route('items.show' , $item->id) }}">
      @if($item->image !== '')
        <img src="{{ asset('storage/' . $item->image) }}">
      @else
        <img src="{{ asset('images/no_image.png') }}">
      @endif
    </a>
    <p>商品名:{{ $item->name }}</p>
    <p>{{ $item->price }} 円</p>
    <!--category_idを変えたい-->
    <p>カテゴリ:{{ $item->category_id }} {{ $item->created_at }}</p>
    
    <p>ステータス</p>
    <p>{{ $item->isOrderedBy($item) ? '売り切れ' : '出品中' }}</p>

  @empty
    <p>お気に入りしている商品はありません。</p>
  @endforelse
@endsection