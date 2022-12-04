<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Requestをインポート
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // AuthenticatesUsers トレイトを利用
    use AuthenticatesUsers;

    // ログイン後のリダイレクト先を変更
    protected $redirectTo = '/home';

    // ログアウト処理以外では、未ログインであることを確認
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // ログアウト後の動作をカスタマイズ
    protected function loggedOut(Request $request)
    {
        // ログイン画面にリダイレクト
        return redirect(route('login'));
    }
}
