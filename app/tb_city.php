<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_city extends Model
{
    //=========== basic
    protected $guarded = ["id"];

    public static function getHtmlOption($provinceId){
        $data = self::where('province_id',$provinceId)->get();
        if($data){
            $html = "<option value='' disabled selected > Select City </option>";
            foreach($data as $city){
                $html .="<option value='".$city->id."'>".$city->city_name."</option>";
            }
            return(object)[
                "success"=>true,
                "data"=>$html
            ];
        }
        return (object)[
            "success"=>false,
            "message"=>"Filed to load city"
        ];
    }
}
