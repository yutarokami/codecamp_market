<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function categories() {
        return $this->belongsTo('App\Category');
    }
}
