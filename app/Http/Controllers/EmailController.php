<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use Redirect,Response,DB,Config;
use Mail;
use App\Models\User;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public $data;
    public function sendEmail($id)
    {
        $user = User::where('id','like', $id) -> first();
        Mail::to($user->email)->send(new MailNotify($user));

        if (Mail::failures()) {
            return response()->json('Sorry! Please try again latter',500);
        }else{
            return response()->json('Great! Successfully send in your mail',200);
        }
    }
}
