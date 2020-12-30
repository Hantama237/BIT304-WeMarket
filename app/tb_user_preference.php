<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\tb_product_cart_history as CartHistory;
use App\tb_product_view_history as ViewHistory;
use App\tb_products as Product;
use App\tb_sub_category as SubCategory;

use Session;
class tb_user_preference extends Model
{
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo('App\tb_category','category_id');
    }

    public static function calculate(){
        $cartHistory = CartHistory::where('user_id',Session::get('id'));
        $ViewHistory = ViewHistory::where('user_id',Session::get('id'));

        $category = [];
        $historyPoint = [];
        foreach ($cartHistory as $h) {
            $historyPoint[$h->sub_category->category->id][$h->taste_id] =+3;
        }
        foreach ($viewHistory as $h) {
            $historyPoint[$h->sub_category->category->id][$h->taste_id] =+1;
        }

        foreach ($historyPoint as $category_id => $taste) {
            foreach ($taste as $taste_id => $point) {
                $pref = self::where('user_id',Session::get('id'))->where('category_id',$category_id)->where('taste_id',$taste_id)->first();
                if($pref){
                    $pref->point = $point;
                    $pref->save();
                }else{
                    self::create([
                        "user_id"=>Session::get('id'),
                        "category_id"=>$category_id,
                        "taste_id"=>$taste_id,
                        "point"=>$point
                    ]);
                }
            }
        }

    }

    public static function generateProducts(){
        $prefBase = self::where('user_id',Session::get('id'));
        $pref = $prefBase->max('point');
        $products = collect();
        if($pref && $pref > 10){
            $pref = $prefBase->where('point','>',10)->get();
            if(count($pref)>=3){
                $pref = $prefBase->where('point','>',10)->orderByDesc('point')->take(5)->get();
                foreach ($pref as $pr) {
                    $subCategoryIds = [];
                    foreach ($pr->category->sub_categories as $c) {
                        array_push($subCategoryIds,$c->id);
                    }
                    foreach(Product::whereIn('sub_category_id',$subCategoryIds)->where('taste_id',$pr->taste_id)->inRandomOrder()->take(floor(20/count($pref)))->get() as $p){
                        $products->push($p);
                    }
                }
            }else{
                $pref = $pref->sortByDesc('point');
                
                foreach ($pref as $pr) {
                    $subCategoryIds = [];
                    foreach ($pr->category->sub_categories as $c) {
                        
                        array_push($subCategoryIds,$c->id);
                    }
                    
                    foreach(Product::whereIn('sub_category_id',$subCategoryIds)->where('taste_id',$pr->taste_id)->inRandomOrder()->take(4)->get() as $p){
                        $products->push($p);
                    }
                }
                foreach(Product::inRandomOrder()->take((20-count($products)))->get() as $p){
                    $products->push($p);
                }
            }
        }else{
            $products = Product::inRandomOrder()->take(20)->get();
        }
        return $products;
    }

}
