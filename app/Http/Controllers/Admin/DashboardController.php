<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Stdclass;
use App\Stdparent;
use App\Teacher;
use Auth;
use App\Admin;
use App\Message;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    private $msgs;
    private $unseen;
    public function msgs(){
        $this->msgs=Message::orderBy('created_at','desc')->limit(4)->get();

        $this->unseen=count(Message::where('seen','=','0')->get());
    }

    public function index(){
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $students=Student::where('active','1')->count();
        $teachers=Teacher::where('active','1')->count();
        $parents=Stdparent::where('active','1')->count();
        $classes=Stdclass::where('active','1')->get();
        $classe=[];
        foreach($classes as $cls){
            $classe[]=['class'=> $cls->name,'total'=> $cls->students->count()];
        }
        $classe=json_encode($classe);
        $stdclasses=count($classes);
    	return view('back.admin.dashboard',compact('students','teachers','parents','stdclasses','classe','msgs','unseen'));
    }

    public function profile(){
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $user=Auth::guard('admin')->user();
        return view('back.admin.profile.view', compact('user','msgs','unseen'));
    }
    public function update($id, Request $request){
        $user=Admin::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'password'=>'nullable|min:8',
            'active'=>'required',
        ]);
        $input=$request->except('_token','password');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        
        $input=$user->update($input);
        return redirect()->back()->with(['success'=>'User details updated successfully']);
    }

    public function storeuser( Request $request){
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'password'=>'required|min:8',
            'active'=>'required',
        ]);
        $input=$request->except('_token','password');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        
        $input=Admin::create($input);
        return redirect()->back()->with(['success'=>'User  added successfully']);
    }

    public function edit($id=null){
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        if($id)
        $user=Admin::findOrFail($id);
        else
        $user=Auth::guard('admin')->user();
        return view('back.admin.profile.edit', compact('user','msgs','unseen'));
    }
    public function createuser(){
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        return view('back.admin.profile.create', compact('msgs','unseen'));
    }
    public function deluser($id){
        $user=Admin::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success'=>'User  account deleted successfully']);
    }
    public function allusers(){
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $users=Admin::where('id','<>','1')->get();
        return view('back.admin.profile.index', compact('users','msgs','unseen'));
    }
}
