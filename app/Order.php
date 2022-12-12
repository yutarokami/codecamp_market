<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function user() {
        return $this->hasOne('App\User', 'user_id');
    }
    
    public function item() {
        return $this->hasOne('App\Item', 'item_id');
    }
}
