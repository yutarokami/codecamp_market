@extends('layouts.logged_in')
 
@section('content')
  <p>息をするように、買おう。</p>
  
  <div>
    <a href="items/create">
      新規出品
    </a>
  </div>
  <div>
    @forelse($items as $item)
      <p>{{ $item->name }}</p>
    @empty
      <p>商品はありません。</p>
    @endforelse
  </div>
@endsection