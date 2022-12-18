<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function likedItem() {
        return $this->belongsTo('App\Item');
    }
    
    public function likedUser() {
        return $this->belongsTo('App\User');
    }
    
    public function likedOrder() {
        return $this->hasOneThrough('App\Order', 'App\Item', 'id', 'item_id');
    }
    
    // 各お気に入り商品が売れているかどうかチェックするメソッド
    public function isOrderedBy($item) {
        // お気に入り商品のうち、売れている商品のitem_idを抜き出す
        $liked_ordered_item_ids = $this->likedOrder->pluck('item_id');
        // 特定の商品のitem_idが、$liked_ordered_item_idsに含まれているかチェック
        $result = $liked_ordered_item_ids->contains($item->id);
    }
    
    
    
    
    
    // これより下は、作成したが使っていないメソッド↓
    
    // お気に入りをしている商品のカテゴリ名を表示するメソッド
    // public function likeItemsCategory() {
    //     // お気に入りをしている商品からidのみを抜き出す
    //     $liked_items = $this->likedItem->pluck('id');
    //     // お気に入りをしている商品のカテゴリ名を抜き出す
    //     $liked_items_category_names = $liked_items->category->pluck('name');
    //     return $liked_items_category_names;
    // }
    
    // 特定のユーザーがどの商品をお気に入りしているか抽出するメソッド
    // public function likeItemsList($user) {
    //     // お気に入りをしている商品に紐付くユーザーのidのみを抜き出す
    //     $liked_users_ids = $this->likedUser->pluck('id');
    //     // $liked_users_idsのうち、特定のユーザー($user)のみを抜き出す
    //     $liked_item_list = $liked_user_ids->contains($user->id);
    //     return $liked_item_list;
    // }
}
