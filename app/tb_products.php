<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tb_sub_category as SubCategory;
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
    public function pictures(){
        return $this->hasMany('App\productPicture','product_id');
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
        $address = $shop->address!=null?$shop->address:"";
        $product->search_tag = 
            $product->name.
            $shop->name.
            $sub_category->sub_category.
            $category.
            $taste.
            ($address!=""?$address->province->province_name:"").
            ($address!=""?$address->city->city_name:"").
            ($address!=""?$address->subdistrict->subdistrict_name:"");
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

    public static function searchRecommendation($categoryId,$taste,$tasteLevel,$price){
        $subCategoryIds = SubCategory::where('category_id',$categoryId)->get();
        $subArray = [];
        foreach ($subCategoryIds as $s) {
            array_push($subArray,$s->id);
        }
        $product = self::where('taste_id',$taste);
        $product = $product->whereIn('sub_category_id',$subArray);
        $product = $product->whereBetween('taste_level',[$tasteLevel-1,$tasteLevel+1]);
        if($price='low'){
            $product = $product->orderBy('price','ASC');
        }else if($price='high'){
            $product = $product->orderBy('price','DESC');
        }else{
            $product =  $product->inRandomOrder();
        }
        $product = $product->paginate(12);

        return $product;
        //dd($product);
    }

    //
}
