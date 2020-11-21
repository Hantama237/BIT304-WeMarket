<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_products as Product;
use App\productPicture as Picture;
use Session;
class productController extends Controller
{
    public function index(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        $shop=Shop::where("id",Session::get("id"))->first();
        $product1 = Product::where('shop_id',$shop->id)->first();
        // dd($product1);
        if($product1 != null){
            // return view("seller.productList",['shop1'=>$shop1, "product"=>$product1]);    
            return redirect('/seller/product-list');
        }
        return view("seller.product",['shop1'=>$shop1]);
    }
    public function productList(){
        $shop=Shop::where("id",Session::get("id"))->first();
        $shop1=Shop::get()->where("id",Session::get("id"));
        // $product=Product::get()->where("id",Session::get("id"));
        $product1 = Product::where('shop_id',$shop->id)->get();
        return view("seller.productList",['shop1'=>$shop1, "product"=>$product1]);
    }
    public function add(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        return view("seller.addProduct",['shop'=>$shop1]);
    }
    //addproduct
    public function addProduct(Request $req){
        $shop = Shop::isExist(Session::get("id"));
        $shop1=Shop::where("id",Session::get("id"))->first();
        $req->merge(["shop_id"=>$shop->id]);
        $validatedData = $req->validate(Product::getValidationRules());
        $this->validate($req, [
            "shop_id"=>"required|exists:tb_shops,id",
            "name"=>"required",
            "description"=>"required|min:3",
            "price"=>"required",
            "stock"=>"required",
            "picture"=>"nullable|file|image|mimes:jpeg,png,jpg|max:2048",
            "status"=>"nullable",
            "filename"=>"nullable",
            "filename.*"=>"file|image|mimes:jpeg,png,jpg|max:2048"
        ]);
        // dd($validatedData);
        if($req->hasfile('picture')){
            $product = Product::addProduct($validatedData);
            // store file data as variable $file
            $picture = $req->file('picture');
            $picture_name = time()."_".$picture->getClientOriginalName();
            // Move file to data_file folder
            $upload_to = 'data_file';
            $picture->move($upload_to,$picture_name);
            //    $shop->insert($request); 
            $product_pic=Product::where('shop_id',$shop1->id)->get()->last();
            $product_pic->picture=$picture_name;
            $product_pic->save();
            // $product = Product::addProduct($validatedData);
            // $product1 = Product::where('shop_id',$shop->id)->first();
            // if($product1 != null){
            //product picture process
            
            if($req->hasfile("filename")){
                foreach($req->file("filename") as $image){
                    $name=$image->getClientOriginalName();
                    $image->move(public_path().'/image/',$name);
                    $data[]=$name;
                }
            }
         
            $upload=new Picture;
            $upload->filename=json_encode($data);
            $upload->product_id=$product_pic->id;
            $upload->save();
            
            return redirect('/seller/product-list')->withSuccess("Address successfully added");
            // }
        }
        return redirect()->back()->withErrors(["Please upload a picture"]);
    }
    public function edit(){
        $shop1=Shop::get()->where("id",Session::get("id"));
        $shop=Shop::where("id",Session::get("id"))->first();
        $product1 = Product::where('shop_id',$shop->id)->get();
        return view("seller.editProduct",['shop1'=>$shop1,"product"=>$product1]);
    }
    //delete
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/seller/edit');
    }
    public function editProduct($id)
    {
        $data = Picture::where('product_id',$id)->get();
       
        $shop1=Shop::get()->where("id",Session::get("id"));
        $product = Product::find($id);
        return view('seller.editForm', ['shop'=>$shop1,'product' => $product,'data'=>$data]);
    }
    //edit
    public function editProcess($id, Request $request)
    {
        $validatedData = $request->validate(Product::getValidationRules());
        $product = Product::find($id);
        $picture = $request->file('picture');
        if($picture !=null){
        $product->name = $request->name;
        $product->description =$request->description;
        $product->price = $request->price;
        $product->stock =$request->stock;
        $picture_name = time()."_".$picture->getClientOriginalName();
        // Move file to data_file folder
		$upload_to = 'data_file';
        $picture->move($upload_to,$picture_name);
         //    $shop->insert($request); 
        $product->picture = $picture_name;
        $product->save();
        }
        $product->name = $request->name;
        $product->description =$request->description;
        $product->price = $request->price;
        $product->stock =$request->stock;
        $product->save();
        //update product picture
        $productPic=Picture::where('product_id',$id)->first();
        $productPic->delete();
        if($request->hasfile("filename")){
            foreach($request->file("filename") as $image){
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/image/',$name);
                $data[]=$name;
            }
        }
        $upload=new Picture;
        $upload->filename=json_encode($data);
        $upload->product_id=$id;
        $upload->save();
        return redirect('/seller/edit');
    }
    
    // public function productPic(){
    //     $shop1=Shop::get()->where("id",Session::get("id"));

        
    //     return view("seller.productPic",['shop1'=>$shop1]);
    // }
}
