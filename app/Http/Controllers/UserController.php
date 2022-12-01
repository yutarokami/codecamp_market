<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // プロフィール詳細
    public function show() {
        return view('users.show', [
            'title' => 'プロフィール',
        ]);
    }
    
    // 出品商品一覧
    public function exhibitions() {
        return view('users.exhibitions', [
            'title' => '出品商品一覧',
        ]);
    }
}
