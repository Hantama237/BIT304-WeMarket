<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_shop extends Model
{
    //
    protected $guarded = ["id"];

    //============ Validation
    // protected static $validationRule = [
    //     "name"=>"required|unique:tb_shops|min:3|regex:^[a-zA-Z0-9_.-]*$^",
    //     "user_id"=>"required|exists:tb_users,id",
    //     "description"=>"required|min:3",
    //     "idcard_picture"=>"nullable",
    //     "status"=>"nullable",
    // ];
    protected static $validationRule = [
        "name"=>"required|unique:tb_shops|min:3|regex:/^\S*$/u",
        
        "user_id"=>"required|exists:tb_users,id",
        "description"=>"required|min:3",
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
