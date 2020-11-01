<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_email_verification as Verification; 
use Session;

class verifyController extends Controller
{
    function verify($code){
        $userId = Session::get("id");
        
        $verificationData = Verification::where("user_id",$userId)->where("code",$code)->first();
        
        if($verificationData && $verificationData->verified != true){
            $verificationData->verified = true;
            $verificationData->save();

            return "Verification success";
        }else{
            return "Verification failed";
        }
    }
}
