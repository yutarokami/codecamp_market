<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function likedItem() {
        return $this->hasOne('App\Item');
    }
}
