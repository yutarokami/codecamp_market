<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function likedItem() {
        return $this->belomgsTo('App\Item');
    }
    
    public function likedUser() {
        return $this->belongsTo('App\User');
    }
    
    // 特定のユーザーがどの商品をお気に入りしているか抽出するメソッド
    public function likeItemsList($user) {
        // お気に入りをしている商品に紐付くユーザーのidのみを抜き出す
        $liked_users_ids = $this->likedUser->pluck('id');
        // $liked_users_idsのうち、特定のユーザー($user)のみを抜き出す
        $liked_item_list = $liked_user_ids->contains($user->id);
        return $liked_item_list;
    }
    
    // お気に入りをしている商品のカテゴリ名を表示するメソッド
    public function likeItemsCategory() {
        // お気に入りをしている商品からidのみを抜き出す
        $liked_items = $this->likedItem->pluck('id');
        // お気に入りをしている商品のカテゴリ名を抜き出す
        $liked_items_category_names = $liked_items->category->pluck('name');
        return $liked_items_category_names;
    }
}
