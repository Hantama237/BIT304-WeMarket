<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use Session;
class shopAuthController extends Controller
{
    //
    public function indexRegister(){
        $shop = Shop::isExist(Session::get("id"));
        if($shop){
            $shop1=Shop::find(Session::get("id"));
           // dd($shop);
            return view('seller.dashboard',['shop1'=>$shop1]);
            //return "Welcome to seller dashboard";
        }
        //return view("seller.dasboard");
    }

    public function register(Request $req){
        $req->merge(["user_id"=>Session::get("id")]);
        $validatedData = $req->validate(Shop::getValidationRules());
        $shop = Shop::register($validatedData);
        if($shop){
            
            return "Shop registration success";
        }
        return redirect()->back();
    }

}
