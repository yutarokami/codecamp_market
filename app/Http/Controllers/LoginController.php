<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class LoginController extends Controller
{
    public function top_login() {
        $user = \Auth::user()->get('id');
        $items = Item::whereNotIn('user_id', $user)->latest();
        // dd($items);
        return view('top_login', [
            'user' => $user,
            'items' => $items,
        ]);
    }
}
