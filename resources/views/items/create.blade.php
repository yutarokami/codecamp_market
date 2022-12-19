@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method='post' action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf
      <label>
          <div>
            商品名：
          </div>
          <div>
            <input type='text' name='name'>
          </div>
      </label>
      <label>
          <div>
            商品説明：
          </div>
          <div>
            <textarea name='description' rows='10' cols='50'></textarea>
          </div>
      </label>
      <label>
          <div>
            価格：
          </div>
          <div>
            <input type='number' name='price'>
          </div>
      </label>
      <label>
          <div>
            カテゴリー：
          </div>
          <div>
            <select name='category_id'>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
          </div>
      </label>
      <label>
          <div>
            画像を選択：
            <input type='file' name='image'>
          </div>
      </label>
      <input type='submit' value='出品'>
  </form>
@endsection