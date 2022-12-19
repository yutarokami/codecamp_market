<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
    
    public function exhibitedUser() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    
    public function orderItem() {
        return $this->hasOne('App\Order');
    }
    
    public function isOrderedBy() {
        // 当該商品が売り切れならば$ordered_item_result=1,そうでなければ$ordered_item_result=0
        $ordered_item_result = Order::where('item_id', $this->id)->count();
        return $ordered_item_result;
    }
    
    public function likeItems() {
        return $this->hasMany('App\Like');
    }
    
    public function likedUsers() {
        return $this->belongsToMany('App\User','likes');
    }
    
    // 特定のユーザーが、各商品に対しお気に入りしているかチェックするメソッド
    public function isLikedBy($user) {
        // お気に入りされている商品に紐づくuser_idを抜き出す
        $like_items_user_ids = $this->likeItems->pluck('user_id');
        // お気に入りされている商品に、特定のユーザーが含まれているか結果を返す
        $result = $like_items_user_ids->contains($user->id);
        return $result;
    }
}
