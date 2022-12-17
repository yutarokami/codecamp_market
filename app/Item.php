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
        return $this->hasOne('App\User');
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
}
