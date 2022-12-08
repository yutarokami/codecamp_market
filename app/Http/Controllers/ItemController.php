<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    // ログイン時でないと開けない設定
    public function __construct() {
        $this->middleware('auth');    
    }
    
    // 新規出品
    public function create() {
        $categories = \DB::table('categories')->get();
        return view('items.create', [
            'title' => '商品を出品',
            'categories' => $categories,
        ]);
    }
    
    // 出品追加処理
    public function store(ItemRequest $request) {
        // 画像投稿処理
        $path = '';
        $image = $request->file('image');
        if( isset($image)===true ) {
            // publicディスク(strage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $category = $request->category;
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $category,
            'price' => $request->price,
            'image' => $path, // ファイルパスを保存
        ]);

        // 登録に成功した場合、該当の商品の詳細ページに遷移する
        session()->flash('success', '出品完了しました');
        return redirect()->route('items.show');
    }
    
    // 商品情報編集
    public function edit() {
        return view('items.edit', [
            'title' => '商品情報の編集',
        ]);
    }
    
    // 商品画像変更
    public function editImage() {
        return view('items.edit_image', [
            'title' => '商品画像の変更',
        ]);
    }
    
    // 商品詳細
    public function show() {
        return view('items.show', [
            'title' => '商品詳細',
        ]);
    }
    
    // 購入確認
    public function confirm() {
        return view('items.confirm', [
            'title' => '',
        ]);
    }
    
    // 購入確定
    public function finish() {
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
        ]);
    }
}
