<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_shop_address as Address;
use Session;
use App\tb_province as Province;
use App\tb_city as City;
use App\tb_subdistrict as SubDistrict;
class orderController extends Controller
{
    //
    public function order(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
            return view('seller.manageOrder',['shop1'=>$shop1]);     
    }


}
