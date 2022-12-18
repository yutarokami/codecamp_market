<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Category;
use App\Item;
use App\Order;

class LikeController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // お気に入り一覧
    public function index() {
        $user = \Auth::user();
        $items = $user->likeItems;
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
}
