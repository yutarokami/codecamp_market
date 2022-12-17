<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class LoginController extends Controller
{
    public function topLogin() {
        $user = \Auth::user();
        $items = Item::with('category')->whereNotIn('user_id', [$user->id])->latest()->get();
        return view('top_login', [
            'items' => $items,
        ]);
    }
}
