<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\tb_email_verification as Verification; 
use App\tb_user as User;

class mailTest extends Controller
{
    function send(){
        $user = User::where("id",1)->first();

        Verification::sendVerificationCode($user);

        return "mail sent";
    }
}
