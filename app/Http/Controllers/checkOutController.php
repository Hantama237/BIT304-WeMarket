<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_products as Product;
use App\tb_orders as Orders;
use App\tb_address as Address;
use App\tb_order_products as OrderProducts;
use App\Functions\cartFunction as Cart;

use Session;
class checkOutController extends Controller
{
    function preview(Request $req){
        //dd($req->input());
        $addresses = Address::where('user_id',Session::get('id'))->get(); 
        if(count($addresses)<1){
            return redirect('/manage/profile')->withErrors(['Please add your address first']);
        }
        $ids = $req->input('id');
        $products = Product::whereIn('id',$ids)->get();
        $cart = Session::get('cart');
        $shops = [];
        $shopProducts = [];
        $ammount = [];
        foreach ($cart as $c) {
            if(in_array($c['id'],$ids)){
                $ammount[$c['id']] = $c['ammount'];
            }
        }
        
        foreach ($products as $p) {
            if(!in_array($p->shop->name,$shops)){
                array_push($shops,$p->shop->name);
                $shopProducts[$p->shop->name] = [];
            }
            array_push($shopProducts[$p->shop->name],$p);
        }
        
        Session::forget('checkout');
        Session::forget('checkout_ids');
        Session::forget('ids');
        Session::put('checkout',$shopProducts);
        Session::put('checkout_ids',$ammount);
        Session::put('ids');
        //dd($shopProducts);
        return view('buyer.order.checkout',['shopProducts'=>$shopProducts,"ammount"=>$ammount,"addresses"=>$addresses]);
    }

    function proceed(Request $req){
        
        $shopProducts = Session::get('checkout');
        $ammount = Session::get('checkout_ids');
        if(!$shopProducts || !$ammount){
            return redirect()->back()->withErrors(['Please checkout your cart first']);
        }
        foreach ($shopProducts as $s) {
            $totalPrice = 0;
            foreach ($s as $p) {
                $totalPrice+= $p->price * $ammount[$p->id];
            }
            $method = $req->delivery_method;
            $address = $req->delivery_method=="take"?$s[0]->shop->address:Address::where('id',$req->address_id)->first();
            $addressStr = $address->postal_code.", ".$address->subdistrict->subdistrict_name.", ".$address->city->city_name.", ".$address->province->province_name.". ".$address->address_detail;
            //dd($addressStr);
            $order = Orders::create([
                "user_id"=>Session::get('id'),
                "shop_id"=>$s[0]->shop->id,
                "status"=>"wait for seller",
                "total_price"=>$totalPrice,
                "payment_method"=>$req->payment_method,
                "delivery_method"=>$method,
                "address"=>$addressStr
            ]);
            foreach ($s as $p) {
                OrderProducts::create([
                    "order_id"=>$order->id,
                    "product_id"=>$p->id,
                    "quantity"=>$ammount[$p->id],
                    "price"=>$p->price,
                ]);
            }
        }
        Session::forget('checkout');
        Session::forget('checkout_ids');

        $ids = Session::get('ids');
        if($ids){
            Cart::removeProducts($ids);
        }
        
        return redirect('/orders');
    }

    function confirm(Request $req){
        $order = Orders::where('id',$req->id)->where('user_id',Session::get('id'))->first();
        $order->status = "complete";
        $order->save();
        return redirect()->back()->withSuccess("Thanks & enjoy the product");
    }

    function history(Request $req){
        $links = Orders::where('user_id',Session::get('id'))->paginate(10);
        $orders = $links->sortByDesc('order_date');
        return view('buyer.order.history',['orders'=>$orders,'links'=>$links->links()]);
    }

    function detail(Request $req){
        $order = Orders::where('id',$req->id)->where('user_id',Session::get('id'))->first();
        return view('buyer.order.detail',['order'=>$order]);
    }
}
