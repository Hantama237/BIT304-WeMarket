<?php

namespace App\Functions;

use Illuminate\Http\Request;
use Session;


class cartFunction{
    public static function getCart(){
        $cart = Session::get('cart');
        if($cart){
            return $cart;
        }
        return false;
    }
    public static function updateProductInfo(){
        $cart = Session::get("cart");
        $newCart = [];
        if($cart){
            foreach ($cart as $c) {
                $product = Product::where('id',$c->id)->first();
                $temp = $c;
                if($product){
                    $temp['price']=$product->price;
                }
                array_push($newCart,$temp);
            }
            Session::put("cart",$newCart);
            return $newCart;
        }
        return false;
    }
    public static function removeProduct($id){
        $cart = Session::get("cart");
        $newCart = [];
        if($cart){
            foreach ($cart as $c) {
                if($c['id']!=$id){
                    array_push($newCart,$c);
                }
            }
            Session::put("cart",$newCart);
            return true;
        }
        return false;
    }
    public static function removeAllCart(){
        Session::forget('cart');
        return true;
    }
}