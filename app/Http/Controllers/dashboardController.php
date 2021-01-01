<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_user_preference as Preference;
use App\tb_products as Products;

class dashboardController extends Controller
{
    function index(){
        Preference::calculate();
        $products = Preference::generateProducts();
        //dd($products);
        return view('buyer.dashboard',['products'=>$products]);
    }
}
