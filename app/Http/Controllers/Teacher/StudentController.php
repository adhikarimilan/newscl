<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Student;
use App\Stdclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\FileUpload;
use File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::get();
        return view('back.teacher.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Stdclass::orderBy('order')->get();
        return view('back.teacher.students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'bail|required|unique:students',
            'per_address'=>'nullable',
            'temp_address'=>'nullable',
            'password'=>'nullable|min:8',
            'active'=>'required',
            'contact'=>'bail|nullable|min:8',
            'class'=>'required'
        ]);
        $input=$request->except('_token');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/students',500,500);
                 }
        }
        $input['class_id']=$request->class;
        $input['section_id']=$request->section;
        $input=Student::create($input);
        $link=route('teacher.students.show',['student'=>$input->id]);
        return redirect()->back()->with(['success'=>'Student added successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=Student::findOrFail($id);
        return view('back.teacher.students.view', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes=Stdclass::orderBy('order')->get();
        $student=Student::findOrFail($id);
        return view('back.teacher.students.edit', compact('classes','student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        return redirect()->back()->with('error','This email belongs to another teacher');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        //  if($request->section){
            //dd($request->section);
             $input['section_id']=$request->section;
        //  }
        //  else{
        //      $input['section_id']=null;
        //  }
        $input['class_id']=$request->class;
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
        $link=route('teacher.students.show',['student'=>$student->id]);
        return redirect()->back()->with(['success'=>'Student details updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::findOrFail($id);
        if($student->avatar)
        if(File::exists($student->avatar))
        unlink($student->avatar);
        $student->delete();
        return redirect(route('teacher.students.index'))->with('success','Student deleted successfully');
    }

    public function getdues(Request $request)
    {   
        $student=Student::findOrFail($request->sid);
        $data=['data'=>$student->issuedbooks()->count()];
        return $data;
    }
}
