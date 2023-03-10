@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <div>
    <a href="{{ route('items.create') }}">
      新規出品
    </a>
  </div>
  <div>
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
      <p>カテゴリ:{{ $item->category->name }} {{ $item->created_at }}</p>
      <p>ステータス</p>
      <p>{{ $item->isOrderedBy($item) ? '売り切れ' : '出品中' }}</p>
      
      <a href="{{ route('items.edit', $item->id) }}">編集</a>
      <a href="{{ route('items.edit_image', $item) }}">画像を変更</a>
      <form method='post' class='delete' action="{{ route('items.destroy', $item) }}">
        @csrf
        @method('delete')
        <input type='submit' value='削除'>
      </form>
    @empty
      <p>出品している商品はありません。</p>
    @endforelse
  </div>
@endsection