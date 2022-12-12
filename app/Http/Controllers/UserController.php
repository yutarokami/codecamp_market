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
        $orders = Order::where('user_id', \Auth::user()->id)->pluck('item_id');
        // dd($orders);
        $order_items = Item::where('id', $orders)->get();
        return view('users.show', [
            'title' => 'プロフィール',
            'user' => $user,
            'item_amount' => $item_amount,
            'order_items' => $order_items,
        ]);
    }
}