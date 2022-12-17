<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // プロフィール編集
    public function edit() {
        $user = \Auth::user();
        return view('profile.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }
    
    // プロフィール編集機能
    public function update(ProfileUpdateRequest $request) {
        $user = \Auth::user();
        $user->update($request->only(['name', 'profile']));
        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.show', $user);
    }
    
    // プロフィール画像編集
    public function editImage() {
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
        ]);
    }
}
