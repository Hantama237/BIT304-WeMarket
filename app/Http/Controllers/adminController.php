<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_admin as Admin;
use App\tb_shop as Shop;
use App\tb_user as User;
use Session;
class adminController extends Controller
{
    public function login(Request $req){
        $validatedData = $req->validate(Admin::getValidationRules());
        $admin = Admin::login($validatedData["username"],$validatedData["password"]);
        //dd($admin);
        if($admin){
            Session::put([
                "admin"=>true
            ]);
            return redirect("/admin/home");
        }
        return redirect()->back()->withErrors(["Incorrect email/password"]);
    }

    public function loginPage(){
        
        return view("admin.login");
    }

    public function home(){
        $shop=Shop::count();
        $user=User::count();
        return view("admin.home",['shop'=>$shop,'user'=>$user]);
    }
    public function verify(){
        $shop= Shop::where("status",0)->get();
        // dd($shop);
        return view("admin.verifySeller",['shop'=>$shop]);
    }
    public function process($id){
        $shop= Shop::find($id);
        // dd($shop);
        $shop->status = 1;
        // dd($shop);
        $shop->save();
        return redirect()->back()->withSuccess("Success to verify seller");
    }

    public function manage(){
        $user= User::where("banned_until",null)->get();
        // dd($user);
        $label="User List";
        $button="Ban";
        $route="banForm";
        return view("admin.manageUser",['user'=>$user,'label'=>$label,'button'=>$button,'route'=>$route]);
    }
    public function banList(){
        $user= User::whereNotNull("banned_until")->get();
        // dd($user);
        $label="Banned user List";
        $button="Revoke ban";
        $route="revoke";
        return view("admin.manageUser",['user'=>$user,'label'=>$label,'button'=>$button,'route'=>$route]);
    }
    public function form($id){
        $user= User::where('id',$id)->first();
        // dd($user);
        return view("admin.form",['user'=>$user]);
    }
    public function revoke($id){
        $user= User::where('id',$id)->first();
        
        $user->banned_until = null;
        $user->save();
        // dd($user);
        return redirect('/admin/manageUser')->withSuccess("Revoke ban success");
    }
    public function ban($id, Request $req){
        $this->validate($req, [
            "banned_until"=>"required|date",
        ]);
        // dd($req);
        $user= User::where('id',$id)->first();

        $user->banned_until = $req->banned_until;
        $user->save();
        // dd($user);
        return redirect('/admin/manageUser')->withSuccess("Ban success");
        }
}
