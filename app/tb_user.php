<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hash;
class tb_user extends Model
{
    //=========== basic
    protected $guarded = ["id"];

    public function addresses(){
        return $this->hasMany('App\tb_address',"user_id");
    }

    public function shop(){
        return $this->hasOne('App\tb_shop',"user_id");
    }

    //============ Validation
    protected static $validationRule = [
        "name"=>"required|regex:/(^[A-Za-z ]+$)+/",
        "email"=>"required|email",
        "password"=>"required|min:8",
        "profile_picture"=>"nullable|file|image|mimes:jpeg,png,jpg|max:2048",
    ];

    public static function getValidationRules(){
        $validationRuleRegister=self::$validationRule;
        $validationRuleRegister["password"].="|confirmed";
        $validationRuleRegister["email"].="|unique:tb_users";
        return $validationRuleRegister;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }
    // =========== End Validation

    // =========== Methods
    public static function register($validatedData){
        $validatedData["password"]=Hash::make($validatedData["password"]);
        return self::create($validatedData);
    }
    public static function login($email,$password){
        $user = self::where("email",$email);
        if(!$user->count()>0){
            return false;
        }
        $user = $user->first();
        if(Hash::check($password, $user->password)){
            return $user;
        }
        return false;
    }
    
}
