<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\tb_products as Product;

class searchController extends Controller
{
    public function search(Request $req){
        $products = Product::search($req->input("keywords"),12);
        $pagination = $products->appends($req->except('page'))->links();
        //dd($products);
        return view('buyer.search.result',["products"=>$products,"pagination"=>$pagination,"keywords"=>$req->input("keywords")]);
    }
    public function detail(Request $req){
        $product = Product::where('id',$req->input('id'))->first();
        //dd($product->shop->products()->paginate(5));
        // $product->shop->products()->paginate(8)->path = "asd";
        // dd($product->shop->products()->paginate(8)->path);
        $pagination = $product->shop->products()->paginate(8)->appends($req->except('page'))->links();
        // /dd($product->shop->products()->paginate(8)->links());
        return view('buyer.search.detail',["product"=>$product,"shop"=>$product->shop,"products"=>$product->shop->products()->paginate(8),"pagination"=>$pagination]);
    }

    public function addToCart(Request $req){
        //get 
       
        //Session::forget("cart");
        $cart = Session::get("cart");
        
        if(!$cart){
            Session::put([
                "cart"=>[
                    [
                        "id"=>$req->input('id'),
                        "ammount"=>$req->input('ammount'),
                        "price"=>$req->input('price')
                    ]
                ]
            ]);
        }else{
            $found = false;
            foreach ($cart as $c) {
                if($req->input('id')==$c['id']){
                    $c['ammount']+=$req->input('ammount');
                    $found=true;
                }
            }
            if(!$found){
                array_push($cart,[
                    "id"=>$req->input('id'),
                    "ammount"=>$req->input('ammount'),
                    "price"=>$req->input('price')
                ]);
            }
            Session::put(["cart"=>$cart]);
        }
        return redirect()->back()->withSuccess("added to cart");
    }
    public function removeFromCart(Request $req){
        $cart = Session::get("cart");
        $newCart = [];
        if($cart){
            foreach ($cart as $c) {
                if($c['id']!=$req->input('id')){
                    array_push($newCart,$c);
                }
            }
            Session::put("cart",$newCart);
        }
        return redirect()->back();
    }
    public function updateCartPrice(Request $req){
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
        }
        return redirect()->back();

    }
}
