<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tb_products as Product;
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
        "idcard_picture"=>"nullable|file|image|mimes:jpeg,png,jpg|max:2048",
        "status"=>"nullable",
        "whatsapp"=>"nullable|numeric"
    ];

    public function address(){
        return $this->hasOne('App\tb_shop_address','shop_id');
    }
    public function products(){
        return $this->hasMany('App\tb_products','shop_id');
    }

    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }
    // =========== End Validation

    // =========== Methods
    public static function register($validatedData){
        return self::create($validatedData);
    }
    public static function isExist($userid){
        return self::where("user_id",$userid)->first();
    }

    //executed when updating shop address/ shop name
    public static function generateAllSearchTag($id){
        $shop = self::where('id',$id)->first();
        $products = $shop->products();
        if($products){
            foreach ($products as $p) {
                Product::generateSearchTag($p->id);
            }
        }
    }
}
