<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_sub_category extends Model
{
    protected $guarded =["id"];
    
    public function category(){
        return $this->belongsTo('App\tb_category','category_id');
    }
}
