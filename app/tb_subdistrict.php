<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_subdistrict extends Model
{
    //=========== basic
    protected $guarded = ["id"];

    public static function getHtmlOption($cityId){
        $data = self::where("city_id",$cityId)->get();
        if($data){
            $html="<option disabled selected>Select Subdistrict</option>";
            foreach($data as $sub){
                $html.="<option value='".$sub->id."'>".$sub->subdistrict_name."</option>";
            }
            return (object)[
                "success"=>true,
                "data"=>$html
            ];
        }
        return (object)[
            "success"=>false,
            "message"=>"Failed to load subdistrict"
        ];
    }
}
