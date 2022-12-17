<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileImageUpdateRequest;

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
        $user = \Auth::user();
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => $user,
        ]);
    }
    
    // プロフィール画像編集機能
    public function updateImage(ProfileImageUpdateRequest $request) {
        // 画像投稿処理
        $path = '';
        $image = $request->file('image');
        
        if( isset($image) === true ) {
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $user = \Auth::user();
        
        // 変更前の画像を削除
        if($user->image !== '') {
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
           'image' => $path, // ファイルを保存 
        ]);
        session()->flash('success', 'プロフィール画像を編集しました');
        return redirect()->route('users.show', $user);
    }
}