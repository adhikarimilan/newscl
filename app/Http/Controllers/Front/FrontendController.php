<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;

class FrontendController extends Controller
{
    public function savemessage(Request $request)
    {
        if($request->ajax())
        {   
            if(trim($request->name)) {
             $message= new Message;
             $message->name= $request->input('name');
             $message->email= $request->input('email');
             $message->subject= $request->input('subject');
             $message->message= $request->input('message');
             $message->seen=0;
             $message->save();
             
             return response()->json(array('data'=>'success'));
            }
        }
    }


}
