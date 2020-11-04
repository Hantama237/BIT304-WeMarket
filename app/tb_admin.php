<?php

namespace App;
use Hash;
use Illuminate\Database\Eloquent\Model;

class tb_admin extends Model
{
    protected static $validationRules = [
        "username"=>"required",
        "password"=>"required"
    ];

    public static function getValidationRules(){
        return self::$validationRules;
    }

    public static function login($username,$password){
        $admin = self::where("username",$username)->first();
        if($admin)
        if(Hash::check($password, $admin->password)){
            return $admin;
        }
        return false;
    }
}
