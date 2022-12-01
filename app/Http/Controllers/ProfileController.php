<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // プロフィール編集
    public function edit() {
        return view('profile.edit', [
            'title' => 'プロフィール編集',
        ]);
    }
    
    // プロフィール画像編集
    public function editImage() {
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
        ]);
    }
}
