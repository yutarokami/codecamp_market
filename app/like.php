<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    // $fillableの設定
    protected $fillable = ['user_id', 'item_id'];
}
