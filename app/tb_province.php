<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_province extends Model
{
    //=========== basic
    protected $guarded = ["id"];

    public static function getHtmlOption(){
        $data = self::get();
        if($data){
            $html="<option value='' disabled selected > Select Province </option>";
            foreach($data as $prov){
                $html.="<option value='".$prov->id."'>".$prov->province_name."</option>";
            }
            return (object)[
                "success"=>true,
                "data"=>$html
            ];
        } 
        return (object)[
            "success"=>false,
            "message"=>"Failed to load province"
        ]; 
    }
}
