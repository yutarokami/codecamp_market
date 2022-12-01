<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // 新規出品
    public function create() {
        return view('items.create', [
            'title' => '商品を出品',
        ]);
    }
    
    // 商品情報編集
    public function edit() {
        return view('items.edit', [
            'title' => '商品情報の編集',
        ]);
    }
    
    // 商品画像変更
    public function editImage() {
        return view('items.edit_image', [
            'title' => '商品画像の変更',
        ]);
    }
    
    // 商品詳細
    public function show() {
        return view('items.show', [
            'title' => '商品詳細',
        ]);
    }
    
    // 購入確認
    public function confirm() {
        return view('items.confirm', [
            'title' => '',
        ]);
    }
    
    // 購入確定
    public function finish() {
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
        ]);
    }
}
