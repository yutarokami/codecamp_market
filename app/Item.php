<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function category() {
        return $this->hasOne('App\Category', 'category_id');
    }
    
    public function user() {
        return $this->hasOne('App\User', 'user_id');
    }
}
