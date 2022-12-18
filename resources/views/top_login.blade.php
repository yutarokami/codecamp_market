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
        <p>お気に入り</p>
        <a class='like_button'>{{ $item->isLikedBy(Auth::user()) ? '済' : '未' }}</a>
        <form method='post' action="{{ route('items.toggle_like', $item) }}">
          @csrf
          @method('patch')
        </form>
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    /* global $ */
    $('.like_button').each(function(){
      $(this).on('click', function(){
        $(this).next().submit();
      });
    });
  </script>
  
@endsection