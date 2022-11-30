<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    // お気に入り一覧
    public function index() {
        return view('likes.index', [
            'title' => 'お気に入り一覧',
        ]);
    }
}
