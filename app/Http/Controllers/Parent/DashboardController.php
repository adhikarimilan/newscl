<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Stdclass;
use App\Stdparent;
use App\Teacher;
use App\Book;
use App\Issuebook;
use App\BookCategories;
use App\Assignment;
use Auth;
use File;
use App\FileUpload;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        return view('back.parent.dashboard');  
    }


    public function profile(){
        $user=Auth::guard('stdparent')->user();
        return view('back.parent.profile.view', compact('user'));
    }
    public function update($id, Request $request){
        $parent=Stdparent::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required|numeric|min:0|max:2',
            'email'=>'bail|required',
            'address'=>'nullable',
            'password'=>'nullable|min:8',
            'active'=>'required',
            'contact'=>'bail|nullable|min:8'
        ]);
        $input=$request->except('_token','password');
        $mail=Stdparent::where('email',$request->email)->first();
        if($mail && !$mail->id==$parent->id)
        return redirect()->back()->with('error','This email belongs to another parent');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        
        if($request->rempic){
            //dd('inside');
            $input['avatar']=null;
            //deleting image
            if($parent->avatar && File::exists($parent->avatar)){
                unlink($parent->avatar);
                $parent->avatar=null;
            }
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/parents',500,500);
                 }
                 if($parent->avatar && File::exists($parent->avatar)){
                    unlink($parent->avatar);
                }
        }
        
        $input=$parent->update($input);
        return redirect()->back()->with(['success'=>'Your details updated successfully']);
    }

    
    public function edit($id=null){
        // if($id)
        // $parent=Stdparent::findOrFail($id);
        // else
        $parent=Auth::guard('stdparent')->user();
        return view('back.parent.profile.edit', compact('parent'));
    }

    public function student($id){
        $student=Student::findOrFail($id);
        $parent=Auth::guard('stdparent')->user();
        $found=false;
        foreach($parent->student_parent as $std){
            if($std->student->id == $id){
                $found=true;
            break;
            }
        }
        if(!$found) abort('403');
        return view('back.parent.child.view',compact('student'));
    }
    public function assignment($id){
        $assignment=Assignment::findOrFail($id);
        return view('back.parent.child.assignmentview',compact('assignment'));
    }
    public function studentassignments($id){
        $student=Student::findOrFail($id);
        $parent=Auth::guard('stdparent')->user();
        $found=false;
        foreach($parent->student_parent as $std){
            if($std->student->id == $id){
                $found=true;
            break;
            }
        }
        if(!$found) abort('403');
        return view('back.parent.child.viewassignments',compact('student'));
    }

    public function stdattendance()
    {
        
        $parent=Auth::guard('stdparent')->user();
        $reqdate=false;
        if(request()->y && request()->m){
            $reqdate=date_create(request()->y.'-'.request()->m);
            if($reqdate)
            $reqdate=date_format($reqdate,"Y-m-");
        }
        else $reqdate=false;
        $students=[];
        foreach($parent->student_parent as $std){
            $student = Student::where('id',$std->student->id)->with('stdattendance')->whereHas('stdattendance', function ($query) use ($reqdate) {
                $date=$reqdate ? $reqdate :date("Y-m-");
                //dd($date);
                $query->where('created_at','like', $date.'%')
                    ;
            });
            if(count($student->get())){   
            $students[] =$student->first();}
            else{
                $student = Student::where('id',$std->student->id)->first();
                $student->stdattendance=null;
                $students[] =$student;
            }
        }
        //dd($students);
        $d=0;
        if($reqdate){
            $d=cal_days_in_month(CAL_GREGORIAN,request()->m,request()->y);
        }
        return view('back.parent.child.viewattendances')->with(['students'=>$students,'reqdate'=>$reqdate,'d'=>$d]);
    }
}
