<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_category extends Model
{
    protected $guarded =['id'];
    public function sub_categories(){
        return $this->hasMany('App\tb_sub_category','category_id');
    }
}
