<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Stdclass;
use App\Stdparent;
use App\Teacher;
use App\Book;
use App\Issuebook;
use App\BookCategories;
use Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
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
    	return view('back.student.dashboard',compact('students','teachers','parents','stdclasses','classe'));
    }

    public function libindex(){
        $books=Book::count();
        $issuedbooks=Issuebook::where('returned','0')->count();
        $categories=BookCategories::get();
        $classe=[];
        foreach($categories as $cate){
            $classe[]=['cat'=> $cate->name,'total'=> $cate->books->count()];
        }
        $classe=json_encode($classe);
        $categories=count($categories);
    	return view('back.teacher.libdashboard',compact('issuedbooks','books','categories','classe'));
    }

    public function profile(){
        $user=Auth::guard('student')->user();
        return view('back.student.profile.view', compact('user'));
    }
    public function update($id, Request $request){
        $student=Student::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required|numeric|min:0|max:2',
            'email'=>'bail|required',
            'per_address'=>'nullable',
            'temp_address'=>'nullable',
            'password'=>'nullable|min:8',
            'active'=>'required',
            'contact'=>'bail|nullable|min:8',
            'roll_no'=>'nullable|numeric|min:1'
        ]);
        $input=$request->except('_token','class','_method','password');
        $mail=Student::where('email',$request->email)->first();
        if($mail && !$mail->id==$student->id)
        return redirect()->back()->with('error','This email belongs to another student');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        
        if($request->rempic){
            $input['avatar']=null;
            //deleting image
            if($student->avatar && File::exists($student->avatar)){
                unlink($student->avatar);
                $student->avatar=null;
            }
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/students',500,500);
                 }
                 if($student->avatar && File::exists($student->avatar)){
                    unlink($student->avatar);
                }
        }

        $input=$student->update($input);
        return redirect()->back()->with(['success'=>'Your details updated successfully']);
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
        
        $input=Teacher::create($input);
        return redirect()->back()->with(['success'=>'User  added successfully']);
    }

    public function edit($id=null){
        if($id)
        $student=Student::findOrFail($id);
        else
        $student=Auth::guard('student')->user();
        return view('back.student.profile.edit', compact('student'));
    }
    public function createuser(){
        return view('back.teacher.profile.create');
    }
    public function deluser($id){
        $user=Teacher::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success'=>'User  account deleted successfully']);
    }
    public function allusers(){
        $users=Teacher::where('id','<>','1')->get();
        return view('back.teacher.profile.index', compact('users'));
    }
}
