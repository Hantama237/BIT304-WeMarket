<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_products as Product;
use App\tb_category as Category;
use App\tb_sub_category as SubCategory;
use App\tb_taste_kind as Taste;
use App\productPicture as Picture;
use Session;
class productController extends Controller
{
    public function index(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        $product1 = Product::where('shop_id',$shop->id)->first();
        // dd($shop);
        // dd(($product1 != null));
        if($product1 != null){
            // return view("seller.productList",['shop1'=>$shop1, "product"=>$product1]);    
            return redirect('/seller/product-list');
        }
        return view("seller.product",['shop1'=>$shop1])->withSuccess("Product successfully added");
    }
    public function productList(){
        $shop=Shop::where("id",Session::get("id"))->first();
        $shop1=Shop::get()->where("id",Session::get("id"));
        // $product=Product::get()->where("id",Session::get("id"));
        $product1 = Product::where('shop_id',$shop->id)->get();
        return view("seller.productList",['shop1'=>$shop1, "product"=>$product1]);
    }
    public function add(){
        $category=Category::get();
        $sub=SubCategory::get();
        $taste=Taste::get();
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        return view("seller.addProduct",['shop'=>$shop1,'category'=>$category,'subCategory'=>$sub,'taste'=>$taste]);
    }
    //addproduct
    public function addProduct(Request $req){
        $shop = Shop::isExist(Session::get("id"));
        $shop1=Shop::where("user_id",Session::get("id"))->first();
        $req->merge(["shop_id"=>$shop->id]);
        $validatedData = $req->validate(Product::getValidationRules());
        // dd($validatedData);
        $this->validate($req, [
            "shop_id"=>"required|exists:tb_shops,id",
            "name"=>"required",
            "description"=>"required|min:3",
            "price"=>"required",
            "stock"=>"required",
            "picture"=>"required|file|image|mimes:jpeg,png,jpg|max:2048",
            "status"=>"nullable",
            "sub_category_id"=>"required",
            "taste_id"=>"required",
            "taste_level"=>"required",
            "filename"=>"nullable",
            "filename.*"=>"file|image|mimes:jpeg,png,jpg|max:2048"
        ]);
        // check file data
        if($req->hasfile('picture')){
            $product = Product::addProduct($validatedData);
            Product::generateSearchTag($product->id);
            // store file data as variable $file
            $picture = $req->file('picture');
            $picture_name = time()."_".$picture->getClientOriginalName();
            // Move file to data_file folder
            $upload_to = 'data_file';
            $picture->move($upload_to,$picture_name);
            $product_pic=Product::where('shop_id',$shop1->id)->get()->last();
            $product_pic->picture=$picture_name;
            $product_pic->save();
            // dd($product_pic);
            //product picture process
            if($req->hasfile("filename")){
                foreach($req->file("filename") as $image){
                    $name=$image->getClientOriginalName();
                    $image->move(public_path().'/image/',$name);
                    $data[]=$name;
                }
                $upload=new Picture;
                $upload->filename=json_encode($data);
                $upload->product_id=$product_pic->id;
                $upload->save();
                // dd($upload);
            }
            return redirect('/seller/product-list')->withSuccess("Product successfully added");
            
        }
        return redirect()->back()->withErrors(["Please upload a picture"]);
    }
    public function edit(){
        $shop1=Shop::get()->where("user_id",Session::get("id"));
        $shop=Shop::where("user_id",Session::get("id"))->first();
        // dd($shop);
        $product1 = Product::where('shop_id',$shop->id)->get();
        // dd($product1->count() ==0);
        if($product1->count() ==0){
            return redirect('/seller/product')->withErrors(["Please add product first"]);
        }
        return view("seller.editProduct",['shop1'=>$shop1,"product"=>$product1]);   
    }
    //delete
    public function delete($id)
    {
        $product = Product::find($id);
        // dd($product);
        $product->delete();
        return redirect('/seller/edit')->withSuccess("success delete product");
    }
    public function editProduct($id)
    {
        $category=Category::get();
        $sub=SubCategory::get();
        $taste=Taste::get();
        $data = Picture::where('product_id',$id)->get();
        $shop1=Shop::get()->where("id",Session::get("id"));
        $product = Product::find($id);
        return view('seller.editForm', ['shop'=>$shop1,'product' => $product,'data'=>$data,'category'=>$category,'subCategory'=>$sub,'taste'=>$taste]);
    }
    //edit
    public function editProcess($id, Request $request)
    {
        $validatedData = $request->validate(Product::getValidationRules());
        // dd($validatedData);
        $product = Product::find($id);
        $picture = $request->file('picture');
        if($picture !=null){
            $product->name = $request->name;
            $product->description =$request->description;
            $product->price = $request->price;
            $product->stock =$request->stock;
            $product->taste_id=$request->taste_id;
            $product->sub_category_id=$request->sub_category_id;
            $product->taste_level=$request->taste_level;
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
        $product->taste_id=$request->taste_id;
        $product->sub_category_id=$request->sub_category_id;
        $product->taste_level=$request->taste_level;
        $product->save();
        Product::generateSearchTag($product->id);
        // dd($product);
        //update product picture
        if($request->hasfile("filename")){
            foreach($request->file("filename") as $image){
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/image/',$name);
                $data[]=$name;
            }
            $productPic=Picture::where('product_id',$id)->first();
            $productPic->delete();
            $productPic=Picture::where('product_id',$id)->first();
            $productPic->delete();
            $upload=new Picture;
            $upload->filename=json_encode($data);
            $upload->product_id=$id;
            $upload->save();
        }
        
        return redirect('/seller/edit')->withSuccess("Successfully edit product");
    }
    
}
