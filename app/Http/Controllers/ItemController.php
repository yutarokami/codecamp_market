<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use App\Order;
use App\Like;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\ItemImageUpdateRequest;

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
        $categories = Category::all();
        return view('items.edit', [
            'title' => '商品情報の編集',
            'item' => $item,
            'categories' => $categories,
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
    public function editImage($id) {
        $item = Item::find($id);
        return view('items.edit_image', [
            'title' => '商品画像の変更',
            'item' => $item,
        ]);
    }
    
    // 商品画像変更機能
    public function updateImage($id, ItemImageUpdateRequest $request) {
        // 画像投稿処理
        $path = '';
        $image = $request->file('image');
        
        if( isset($image) === true ) {
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $item = Item::find($id);
        
        // 変更前の画像を削除
        if($item->image !== '') {
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        
        $item->update([
           'image' => $path, // ファイルを保存 
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show', $id);
    }
    
    // 商品詳細
    public function show($id) {
        $item = Item::find($id);
        $category = Category::where('id',$item->category_id)->value('name');
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
            'category' => $category,
        ]);
    }
    
    // 購入確認
    public function confirm($id) {
        $item = Item::find($id);
        $category = Category::where('id',$item->category_id)->value('name');
        return view('items.confirm', [
            'item' =>$item,
            'category' => $category,
        ]);
    }
    
    // 購入処理
    public function toggleOrder($id) {
        $item = Item::find($id);
        
        if($item->isOrderedBy()===1) {
            // 売り切れの場合
            \Session::flash('error', '申し訳ありません。ちょっと前に売り切れました。');
            return redirect()->route('items.show', $id);
        } else {
            // 出品中の場合
            Order::create([
               'user_id' => \Auth::user()->id,
               'item_id' => $id,
            ]);
            return redirect()->route('items.finish', $id);
        }
    }
    
    // 購入確定
    public function finish($id) {
        $item = Item::find($id);
        $category = Category::where('id',$item->category_id)->value('name');
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
            'item' =>$item,
            'category' => $category,
        ]);
    }
    
    // お気に入り追加処理
    public function toggleLike($id) {
        $user = \Auth::user();
        $item = Item::find($id);
        
        if($item->isLikedBy($user)) {
            // お気に入りの取り消し
            $item->likeItems->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'お気に入りを取り消しました');
        } else {
            // お気に入りを設定
            Like::create([
               'user_id' => $user->id,
               'item_id' => $item->id,
            ]);
            \Session::flash('success', 'お気に入りしました');
        }
        return redirect()->route('top_login');
    }
}
