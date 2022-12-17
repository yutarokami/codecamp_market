@extends('layouts.logged_in')
 
@section('content')
  <p>息をするように、買おう。</p>
  
  <div>
    <a href="{{ route('items.create') }}">
      新規出品
    </a>
  </div>
  <div>
    @forelse($items as $item)
      <div>
        <p>商品名</p>
        <p>{{ $item->name }}</p>
      </div>
      <div>
        <p>画像</p>
        <a href="{{ route('items.show' , $item->id) }}">
          <img src="{{ asset('storage/' . $item->image) }}">
        </a>
      </div>
      <div>
        <p>カテゴリ</p>
        <p>{{ $item->category->name }}</p>
      </div>
      <div>
        <p>価格</p>
        <p>{{ $item->price }}</p>
      </div>
      <div>
        <p>説明</p>
        <p>{{ $item->description }}</p>
      </div>
      <div>
        <p>ステータス</p>
        <p>{{ $item->isOrderedBy($item) ? '売り切れ' : '出品中' }}</p>
      </div>
    @empty
      <p>商品はありません。</p>
    @endforelse
  </div>
  
  
@endsection