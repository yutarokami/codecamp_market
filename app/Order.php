<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
    
    public function orderedUser() {
        return $this->hasOne('App\User');
    }
    
    public function orderedItem() {
        return $this->hasOne('App\Item');
    }
}
