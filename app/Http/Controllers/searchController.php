<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\tb_products as Product;

class searchController extends Controller
{
    public function search(Request $req){
        $req->validate([
            "keywords"=>"required|string"
        ]);
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
        $product = Product::where('id',$req->input('id'))->first();
        
        if(!$product){
            return redirect()->back()->withErrors(["Failed, product not valid"]);
        }
        if($req->input('ammount')<1){
            return redirect()->back()->withErrors(['Invalid amount']);
        }
        if(!$cart){
            Session::put([
                "cart"=>[
                    [
                        "id"=>$req->input('id'),
                        "name"=>$product->name,
                        "ammount"=>$req->input('ammount'),
                        "price"=>$product->price
                    ]
                ]
            ]);
        }else{
            $found = false;
            $newCart = [];
            foreach ($cart as $c) {
                $temp = $c;
                if($req->input('id')==$c['id']){
                    if($temp['ammount']-$req->input('ammount') >1){
                        $temp['ammount']+=$req->input('ammount');
                    }
                    $temp['name']=$product->name;
                    $temp['price']=$product->price;
                    $found=true;
                }
                array_push($newCart,$temp);
            }
            if(!$found){
                array_push($newCart,[
                    "id"=>$req->input('id'),
                    "name"=>$product->name,
                    "ammount"=>$req->input('ammount'),
                    "price"=>$product->price
                ]);
            }
            //Session::forget("cart");
            Session::put("cart",$newCart);
            //dd($cart);
        }
        return redirect()->back()->withSuccess("added to cart");
    }
    public function setAmmount(Request $req){
        $cart = Session::get('cart');
        $newCart = [];
        $product = Product::where('id',$req->input('id'))->first();
        if($req->input('ammount')<1){
            return redirect()->back()->withErrors(['Invalid amount']);
        }
        if(!$product){
            return redirect()->back()->withErrors(["Failed, product not valid"]);
        }
        if($cart){
            foreach ($cart as $c) {
                $temp = $c;
                if($c['id']==$req->input('id')){
                    if($product){
                        if($product->stock<$req->input('ammount')){
                            return redirect()->back()->withErrors(["Stock is less than desired ammount!"]);
                        }else{
                            if($req->input('ammount')>0){
                                $temp['ammount']=$req->input('ammount');
                            }else{
                                return redirect()->back()->withErrors(["Ammount must be more than 0"]);
                            }
                        }
                    }else{
                        return redirect()->back()->withErrors(["Product is invalid, please try again or remove product"]);
                    }
                    
                }
                array_push($newCart,$temp);
            }
            Session::put("cart",$newCart);
        }
        return redirect()->back()->withSuccess("update success");
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
