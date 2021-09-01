<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactDetail;
use Session;
class ContactController extends Controller
{
    public function index(){
    	$contact=ContactDetail::first();
        if(!$contact)
        return view('back.admin.contactdetails.create');
    	return view('back.admin.contactdetails.index',compact('contact'));
    }
    public function edit(){
    	$contact=ContactDetail::first();
    	return view('back.admin.contactdetails.edit',compact('contact'));
    }
    public function update(Request $request){
        $this->validate($request,[
            'headertext'=>'required',
        ]);
        $input=$request->except('_token');  
        $contact=ContactDetail::first();
        if(!$contact)
        {
        $input=ContactDetail::create($input);
        return redirect()->route('admin.contact')->with('success','Contact Details has been added successfully.');
        }
        $contact=$contact->update($input); 	
    	return redirect()->route('admin.contact')->with('success','Contact Details has been updated successfully.');
    }
}
