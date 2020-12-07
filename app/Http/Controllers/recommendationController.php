<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_taste_kind as Taste;
use App\tb_category as Category;
use App\tb_products as Product;
class recommendationController extends Controller
{
    public function index(Request $req){
        $taste = Taste::get();
        $category = Category::get();
        return view('buyer.recommendation.form',["taste"=>$taste,"category"=>$category]);
    }

    public function searchRecommendation(Request $req){
        $data = $req->validate([
            "category"=>"required|exists:tb_categories,id",
            "taste"=>"required|exists:tb_taste_kinds,id",
            "taste_level"=>"required|numeric|min:1|max:5",
            "price"=>"required|string"
        ]);
        //dd($data);
        $products = Product::searchRecommendation($data['category'],$data['taste'],$data['taste_level'],$data['price']);
        $pagination = $products->appends($req->except('page'))->links();
        return view('buyer.recommendation.result',["products"=>$products,"pagination"=>$pagination]);
    }
}
