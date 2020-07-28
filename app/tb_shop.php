<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_shop extends Model
{
    //
    protected $guarded = ["id"];

    //============ Validation
    protected static $validationRule = [
        "name"=>"required|unique:tb_shops",
        "user_id"=>"required|exists:tb_users,id",
        "description"=>"required",
        "idcard_picture"=>"nullable",
        "status"=>"nullable",
    ];

    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }
    // =========== End Validation

    // =========== Methods
    public static function register($validatedData){
        return self::insert([$validatedData]);
    }
    public static function isExist($userid){
        return self::where("user_id",$userid)->first();
    }
}
