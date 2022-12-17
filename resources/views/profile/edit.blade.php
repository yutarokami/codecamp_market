@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form action="{{ route('profile.update') }}" method='post'>
    @csrf
    @method('patch')
    <div>
        名前:<br>
        <input type='text' name='name' value={{ $user->name }}>
    </div>
    <div>
        プロフィール:<br>
        <textarea name='profile' rows='5' cols='40'>{{ $user->profile }}</textarea>
    </div>
    <input type='submit' value='更新'>
  </form>
@endsection