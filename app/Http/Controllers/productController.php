<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_product as Product;
use Session;
class productController extends Controller
{
    public function index(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        return view("seller.product",['shop1'=>$shop1]);
    }
    public function add(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        return view("seller.addProduct",['shop'=>$shop1]);
    }

    public function edit(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        return view("seller.editProduct",['shop1'=>$shop1]);
    }
}
