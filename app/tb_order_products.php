<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_order_products extends Model
{
    //=========== basic
    protected $guarded = ["id"];
    public function product(){
        return $this->belongsTo('App\tb_products','product_id');
    }
}
