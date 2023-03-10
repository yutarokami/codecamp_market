<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function orderedUser() {
        return $this->belongsTo('App\User');
    }
    
    public function orderedItem() {
        return $this->hasOne('App\Item');
    }
    
    public function orderedLikes() {
        return $this->hasOneThrough('App\Like', 'App\Item');
    }
}
