<?php

namespace App\Http\Controllers;

use App\User;
use App\Item;
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
}