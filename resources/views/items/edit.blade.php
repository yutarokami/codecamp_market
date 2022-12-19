@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form action="{{ route('items.update', $item) }}" method='post'>
    @csrf
    @method('patch')
    <div>
      商品名:</br> 
      <input type='text' name='name' value={{ $item->name }}>
    </div>
    <div>
      商品説明:</br> 
      <textarea name='description' rows='5' cols='40'>{{ $item->description }}</textarea>
    </div>
    <div>
      価格:</br> 
      <input type='text' name='price' value={{ $item->price }}>
    </div>
    <div>
      カテゴリー:</br> 
      <select name='category_id'>
        @foreach($categories as $category)
          @if($item->category_id === $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
          @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <input type='submit' value='出品'>
  </form>
@endsection