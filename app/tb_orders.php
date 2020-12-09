<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_orders extends Model
{
    //=========== basic
    protected $guarded = ["id"];
    
    public function shop(){
        return $this->belongsTo('App\tb_shop','shop_id');
    }
    public function user(){
        return $this->belongsTo('App\tb_user','user_id');
    }
    public function products(){
        return $this->hasMany('App\tb_order_products','order_id');
    }
}
