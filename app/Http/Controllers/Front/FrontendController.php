<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Schoolevent;

class FrontendController extends Controller
{
    public function index(){
        $events=Schoolevent::orderBy('event_date','desc')->limit(6)->get();
        return view('front.welcome',compact('events'));
    }

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

    public function gallery(){

    }

    public function events(){
        $events=Schoolevent::orderBy('event_date','desc')->get();
        return view('front.events',compact('events'));  
    }

    public function singleevent($id){
        
    }
    
    public function downloads(){

    }



}
