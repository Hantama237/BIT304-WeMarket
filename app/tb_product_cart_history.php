<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_product_cart_history extends Model
{
    //
    protected $table="tb_product_cart_history";

    public function sub_category(){
        return $this->belongsTo('App\tb_sub_category');
    }
    
}
