<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_orders as Order;
use App\tb_order_products as orderProduct;
use App\tb_products as Product;
use App\tb_shop_address as Address;
//testhistory
use App\tb_product_view_history as View;
use App\tb_product_cart_history as Cart;
use App\tb_category_search_history as SearchHistory;
use Session;
class orderController extends Controller
{
    //
    public function order(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        // dd($shop);
        $order=Order::get()->where("shop_id",$shop->id)->where('status',"wait for seller");
        // $order1=Order::where("shop_id",$shop->id)->first();
        // $count=count($order);
        // dd($order);
        $orderProduct=orderProduct::get();
        // $orderProduct1=orderProduct::where("order_id",$order1->id)->first();
        $product=Product::get()->where("shop_id",$shop->id);
        // dd($product);
        // dd($product);,'orderProduct'=>$orderProduct,'product'=>$product]
        return view('seller.manageOrder',['shop1'=>$shop1,'order'=>$order,'orderProduct'=>$orderProduct,'product'=>$product]);     
    }
    public function cancel($id){
        $order=Order::find($id);
        //test history
        $product=Product::find(3);
        // dd($product);
        $view= new View;
        $view->user_id= Session::get("id");
        $view->sub_category_id= $product->sub_category_id;
        $view->taste_id=$product->taste_id;
        $view->product_name= $product->name;
        $view->save();
        dd($view);
        // $cart= new Cart;
        // $cart->user_id= Session::get("id");
        // $cart->sub_category_id= $product->sub_category_id;
        // $cart->taste_id=$product->taste_id;
        // $cart->product_name=$product->name;
        // $cart->save();
        // dd($cart);
        // $search= new SearchHistory;
        // $search->sub_category_id=$product->sub_category_id;
        // $search->user_id=Session::get("id");
        // $search->save();
        // dd($search);
        $order->status ="your order decline";
        $order->save();
        // dd($order);
        return redirect('/seller/order')->withSuccess("Success to decline order");
    }
    public function process($id){
        $order=Order::find($id);
        dd($order);
        if($order->delivery_method == 'Delivery'){
            $order->status ="on delivery";
            $order->save();
            // dd($order);
        }
        $order->status ="waiting you to come";
        $order->save();
        // dd($order);
        return redirect('/seller/order')->withSuccess("Remember to pack product");
    }
    public function complete($id){
        $order=Order::find($id);
        $order->status ="complete";
        $order->save();
        return redirect()->back()->withSuccess("Thanks & enjoy the product");
    }
    public function status(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        $order=Order::where("shop_id",$shop->id)->where('status',"!=","wait for seller")->get();
        $orderProduct=orderProduct::get();
        $product=Product::get();
        return view('seller.takeDelivery',['shop1'=>$shop1,'order'=>$order,'orderProduct'=>$orderProduct,'product'=>$product]);     
    }
}
