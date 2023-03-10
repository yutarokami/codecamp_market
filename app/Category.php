<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // $fillableの設定
    protected $fillable = ['name'];
    
    public function categoryOfItems() {
        return $this->hasMany('App\Item');
    }
    
    public function categoryOfOrders() {
        return $this->hasMany('App\Order');
    }
    
    public function orderUsers() {
        return $this->belongsToMany('App\User', 'categoryOfOrders');
    }
}
