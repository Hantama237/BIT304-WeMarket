<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_shop_address extends Model
{
    protected $guarded = ["id"];

    //============ Validation
    protected static $validationRule = [
        "shop_id"=>"required|exists:tb_shops,id",
        "address_detail"=>"required|string",
        "province_id"=>"required",
        "city_id"=>"required",
        "subdistrict_id"=>"required",
        "postal_code"=>"required",
        "coordinates"=>"nullable",
    ];

    public function province(){
        return $this->belongsTo('App\tb_province');
    }
    public function city(){
        return $this->belongsTo('App\tb_city');
    }
    public function subdistrict(){
        return $this->belongsTo('App\tb_subdistrict');
    }

    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }
    // =========== End Validation

    public static function addAddress($validatedData){
        if(self::where("shop_id",$validatedData["shop_id"])->get()->count()<1){
            return self::create($validatedData);
        }
        return false;   
    }
    public static function updateAddress($addressId,$shopId,$validatedData){
        return self::where("id",$addressId)->where("shop_id",$shopId)->update($validatedData);
    }
}