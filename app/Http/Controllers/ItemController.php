<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUpdateRequest;

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
        $item = Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $category,
            'price' => $request->price,
            'image' => $path, // ファイルパスを保存
        ]);
        
        // 登録に成功した場合、該当の商品の詳細ページに遷移する
        session()->flash('success', '出品完了しました');
        return redirect()->route('items.show',$item);
    }
    
    // 商品情報編集画面
    public function edit($id) {
        $item = Item::find($id);
        $category_default = Category::where('id',$item->category_id)->first();
        $categories = \DB::table('categories')->whereNotIn('id',[$category_default->id])->get();
        
        return view('items.edit', [
            'title' => '商品情報の編集',
            'item' => $item,
            'name' => $item->name,
            'description' => $item->description,
            'categories' => $categories,
            'category_default' => $category_default,
            'price' => $item->price,
        ]);
    }
    
    // 商品情報編集機能
    public function update($id, ItemUpdateRequest $request) {
        $item = Item::find($id);
        $item->update($request->except(['image']));
        session()->flash('success', '商品情報を編集しました');
        return redirect()->route('items.show', $id);
    }
    
    // 商品情報削除機能
    public function destroy($id) {
        $item = Item::find($id);
        $item->delete();
        session()->flash('success', '商品情報を削除しました');
        return redirect()->route('users.exhibitions', \Auth::user()->id);
    }
    
    // 商品画像変更
    public function editImage() {
        return view('items.edit_image', [
            'title' => '商品画像の変更',
        ]);
    }
    
    // 商品詳細
    public function show($id) {
        $item = Item::find($id);
        $name = $item->name;
        $image = $item->image;
        $category = Category::where('id',$item->category_id)->value('name');
        $price = $item->price;
        $description = $item->description;
        return view('items.show', [
            'title' => '商品詳細',
            'name' => $name,
            'image' => $image,
            'category' => $category,
            'price' => $price,
            'description' => $description,
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
