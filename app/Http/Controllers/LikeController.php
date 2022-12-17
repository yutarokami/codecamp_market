<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Category;

class LikeController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // お気に入り一覧
    public function index() {
        $user = \Auth::user();
        $items = Like::where('user_id', $user->id)->latest()->get();
        // $category = ;
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
            // 'category' => $category,
        ]);
    }
}
