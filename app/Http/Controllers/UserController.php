<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
use App\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        $item_amount = Item::where('user_id', $id)->count();

        return view('users.show', [
            'title' => 'プロフィール',
            'user' => $user,
            'item_amount' => $item_amount,
        ]);
    }
    
    // 出品商品一覧
    public function exhibitions($id) {
        $user = User::find($id);
        $user_name = $user->name;
        $items = Item::where('user_id', $id)->latest()->get();
        
        return view('users.exhibitions', [
            'title' => $user_name . 'の出品商品一覧',
            'items' => $items,
        ]);
    }
}