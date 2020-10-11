<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Stdclass;
use App\Stdparent;
use App\Teacher;
use App\Book;
use App\Issuebook;
use App\BookCategories;
use App\FileUpload;
use Auth;
use File;
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
    	return view('back.teacher.dashboard',compact('students','teachers','parents','stdclasses','classe'));
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
        $user=Auth::guard('teacher')->user();
        return view('back.teacher.profile.view', compact('user'));
    }
    public function update($id, Request $request){
        
        $teacher=Teacher::findOrFail($id);
        dd($teacher);
        $mail=Teacher::where('email',$request->email)->first();
        if($mail && $mail->id!=$teacher->id)
        return redirect()->back()->with('error','This email ('.$request->email.') belongs to another teacher');
        $input=$request->except('_token');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        if($request->rempic){
            $input['avatar']=null;
            //deleting image
            if($teacher->avatar && File::exists($teacher->avatar)){
                unlink($teacher->avatar);
                $teacher->avatar=null;
            }
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/teachers',500,500);
                 }
                 if($teacher->avatar && File::exists($teacher->avatar)){
                    unlink($teacher->avatar);
                }
        }
        $input=$teacher->update($input);
        return redirect()->back()->with(['success'=>'User details updated successfully']);
    }

    

    public function edit($id=null){
        if($id)
        $teacher=Teacher::findOrFail($id);
        else
        $teacher=Auth::guard('teacher')->user();
        return view('back.teacher.profile.edit', compact('teacher'));
    }
    public function createuser(){
        return view('back.teacher.profile.create');
    }
    
}
