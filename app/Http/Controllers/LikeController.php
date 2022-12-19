<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Category;
use App\Item;
use App\Order;
use App\User;

class LikeController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // お気に入り一覧
    public function index() {
        $user = \Auth::user();
        // itemsテーブルのcreated_atの新しい順ではなく、likesテーブルのにしたい
        $items = $user->likeitems()->latest('likes.created_at')->get();//->sortByDesc('likes.created_at');
        // dd($items);
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
}
