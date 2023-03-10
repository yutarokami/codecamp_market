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

// トップページ(未ログイン時)
Route::view('/', 'top_signin');

// トップページ(ログイン時)
Route::get('/home', 'LoginController@topLogin')->name('top_login');

// ログイン関連
Auth::routes();

//// プロフィール関連 ////
// プロフィール詳細
Route::get('users/{user}', 'UserController@show')->name('users.show');

// プロフィール編集
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');

// プロフィール編集機能
Route::patch('profile/edit', 'ProfileController@update')->name('profile.update');

// プロフィール画像編集
Route::get('profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');

// プロフィール画像編集機能
Route::patch('profile/edit_image', 'ProfileController@updateImage')->name('profile.update_image');

//// 出品関連 ////
// 出品商品一覧
Route::get('users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');

// 新規出品
Route::get('items/create', 'ItemController@create')->name('items.create');

// 新規出品追加処理
Route::post('items/store', 'ItemController@store')->name('items.store');

// 商品情報編集
Route::get('items/{item}/edit', 'ItemController@edit')->name('items.edit');

// 商品情報編集機能
Route::patch('items/{item}/edit', 'ItemController@update')->name('items.update');

// 商品情報削除機能
Route::delete('items/{item}/edit', 'ItemController@destroy')->name('items.destroy');

// 商品画像変更
Route::get('items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');

// 商品画像変更機能
Route::patch('items/{item}', 'ItemController@updateImage')->name('items.update_image');

//// 購入関連 ////
// 商品詳細
Route::get('items/{item}', 'ItemController@show')->name('items.show');

// 購入確認
Route::get('items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');

// 購入処理
Route::patch('items/{item}/toggle_order', 'ItemController@toggleOrder')->name('items.toggle_order');

// 購入確定
Route::get('items/{item}/finish', 'ItemController@finish')->name('items.finish');

//// そのほか ////
// お気に入り一覧
Route::get('likes', 'LikeController@index')->name('likes.index');

// お気に入り追加処理
Route::patch('items/{item}/toggle_like', 'ItemController@toggleLike')->name('items.toggle_like');