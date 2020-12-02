<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_orders as Order;
use App\tb_order_products as orderProduct;
use App\tb_products as Product;
use App\tb_shop_address as Address;
use Session;
class orderController extends Controller
{
    //
    public function order(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        // dd($shop1[0]->id);
        $order=Order::get()->where("shop_id",$shop->id)->where('status',"wait for seller");
        // $order1=Order::where("shop_id",$shop->id)->first();
        $count=count($order);
        // dd($count);
        $orderProduct=orderProduct::get();
        // $orderProduct1=orderProduct::where("order_id",$order1->id)->first();
        $product=Product::get();
        // dd($product);,'orderProduct'=>$orderProduct,'product'=>$product]
        return view('seller.manageOrder',['shop1'=>$shop1,'order'=>$order,'orderProduct'=>$orderProduct,'product'=>$product]);     
    }
    public function cancel($id){
        $order=Order::find($id);
        $order->status ="your order decline";
        $order->save();
        return redirect('/seller/order')->withSuccess("Success to decline order");
    }
    public function process($id){
        $order=Order::find($id);
        if($order->delivery_method == 'Delivery'){
            $order->status ="on delivery";
            $order->save();
        }
        $order->status ="waiting you to come";
        $order->save();
        return redirect('/seller/order')->withSuccess("Remember to process order");
    }
    public function status(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        // dd($shop1[0]->id);
        $order=Order::where("shop_id",$shop->id)->where('status',"!=","wait for seller")->get();
        $orderProduct=orderProduct::get();
        // $orderProduct1=orderProduct::where("order_id",$order1->id)->first();
        $product=Product::get();
        return view('seller.takeDelivery',['shop1'=>$shop1,'order'=>$order,'orderProduct'=>$orderProduct,'product'=>$product]);     
    }
}
