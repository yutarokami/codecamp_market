<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function category() {
        return $this->hasOne('App\Category');
    }
    
    public function user() {
        return $this->hasOne('App\User');
    }
    
    public function orders() {
        return $this->hasMany('App\Order');
    }
}
