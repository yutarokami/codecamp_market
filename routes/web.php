<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// トップページ
Route::view('/', 'top');

// ログイン関連
Auth::routes();

//// プロフィール関連 ////
// プロフィール詳細
Route::get('users/{user}', 'UserController@show')->name('users.show');

// プロフィール編集
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');

// プロフィール画像編集
Route::get('profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');

//// 出品関連 ////
// 出品商品一覧
Route::get('users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');

// 新規出品
Route::get('items/create', 'ItemController@create')->name('items.create');

// 商品情報編集
Route::get('items/{item}/edit', 'ItemController@edit')->name('items.edit');

// 商品画像変更
Route::get('items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');

//// 購入関連 ////
// 商品詳細
Route::get('items/{item}', 'ItemController@show')->name('items.show');

// 購入確認
Route::get('items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');

// 購入確定
Route::get('items/{item}/finish', 'ItemController@finish')->name('items.finish');

//// そのほか ////
// お気に入り一覧
Route::get('likes', 'LikeController@index')->name('likes.index');