<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_address extends Model
{
    //
    protected $guarded = ["id"];

    //============ Validation
    protected static $validationRule = [
        "user_id"=>"required|exists:tb_users,id",
        "address_detail"=>"required|string",
        "province_id"=>"required",
        "city_id"=>"required",
        "subdistrict_id"=>"required",
        "coordinates"=>"nullable",
    ];

    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }
    // =========== End Validation

    // =========== Methods
    public static function addAddress($validatedData){
        if(self::where("user_id",$userId)->get()->count()<5){
            return self::create($validatedData);
        }
        return false;   
    }
    public static function updateAddress($addressId,$userId,$validatedData){
        return self::where("id",$addressId)->where("user_id",$userId)->update($validatedData);
    }
    public static function deleteAddress($addressId,$userId){
        return self::where("id",$addressId)->where("user_id",$userId)->delete();
    }
}
