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
        "taste_id"=>"required|exists:tb_taste_kinds,id",
        "sub_category_id"=>"required|exists:tb_sub_categories,id",
        "sold"=>"nullable|numeric",
        "taste_level"=>"required|numeric",
        "search_tag"=>"nullable|string",

    ];
    public function sub_category(){
        return $this->belongsTo('App\tb_sub_category','sub_category_id');
    }
    public function taste(){
        return $this->belongsTo('App\tb_taste_kind','taste_id');
    }
    public function shop(){
        return $this->belongsTo('App\tb_shop','shop_id');
    }


    public static function getValidationRules(){
        return self::$validationRule;
    }
    public static function getValidationRule($key){
        return self::$validationRule[$key];
    }

    //method
    public static function addProduct($validatedData){
        return self::create($validatedData);
    }
    public static function isExist($userid){
        return self::where("user_id",$userid)->first();
    }

    public static function generateSearchTag($id){
        $product = self::where("id",$id)->first();
        $sub_category = $product->sub_category;
        $category = $sub_category->category->category;
        $shop = $product->shop;
        $taste = $product->taste->taste;
        $address = $shop->address;
        $product->search_tag = 
            $product->name.
            $shop->name.
            $sub_category->sub_category.
            $category.
            $taste.
            $address->province->province_name.
            $address->city->city_name.
            $address->subdistrict->subdistrict_name;
        $product->save();
    }

    public static function search($keywords,$paginate = 8){
        $words = explode(' ', $keywords);
        $products=self::with([]);
        foreach ($words as $w) {
            $products=$products->where('search_tag', 'like', '%' . $w . '%');
        }   
        $products =$products->paginate($paginate); 
        if($products){
            return $products;
        }
        return false;
        
    }

    //
}
