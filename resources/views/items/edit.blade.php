@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form action="{{ route('items.update', $item->id) }}" method='post'>
    @csrf
    @method('patch')
    <div>
      商品名:</br> 
      <input type='text' name='name' value={{$name}}>
    </div>
    <div>
      商品説明:</br> 
      <textarea name='description' rows='5' cols='40'>{{$description}}</textarea>
    </div>
    <div>
      価格:</br> 
      <input type='text' name='price' value={{$price}}>
    </div>
    <div>
      カテゴリー:</br> 
      <select name='category'>
        <option value="{{ $category_default->id }}">{{ $category_default->name }}</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <input type='submit' value='出品'>
  </form>
@endsection