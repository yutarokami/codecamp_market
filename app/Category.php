<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // $fillableの設定
    protected $fillable = ['name'];
    
    public function items() {
        return $this->hasMany('App\Item');
    }
}
