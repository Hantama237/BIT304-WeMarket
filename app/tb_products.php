<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_products extends Model
{
    protected $guarded = ["id"];
    

    //validation
    protected static $validationRule = [
        "shop_id"=>"required|exists:tb_shops,id",
        "name"=>"required",
        "description"=>"required|min:3",

        "price"=>"required|numeric",
        "stock"=>"required|numeric",
        "picture"=>"nullable|file|image|mimes:jpeg,png,jpg|max:2048",
        "status"=>"nullable",
        //newly added
        "taste_id"=>"required|exists:tb_products,id",
        "sub_category_id"=>"",
        "sold"=>"nullable|numeric",
        "taste_level"=>"required|numeric",
        "search_tag"=>"nullable|string",

    ];
    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }

    //method
    public static function addProduct($validatedData){
        return self::insert([$validatedData]);
    }
    public static function isExist($userid){
        return self::where("user_id",$userid)->first();
    }

    public static function generateSearchTag($id){

    }

    //
}
