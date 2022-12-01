<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // お気に入り一覧
    public function index() {
        return view('likes.index', [
            'title' => 'お気に入り一覧',
        ]);
    }
}
