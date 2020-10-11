<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Assignment;
use App\Stdclass;
use App\FileUpload;
use Illuminate\Http\Request;
use Auth;
use File;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments=Assignment::orderBy('created_at')->get();
        return view('back.teacher.assignment.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Stdclass::orderBy('order')->get();
        return view('back.teacher.assignment.create', compact('classes'));
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
            'description'=>'required',
            'class'=>'required',
            'file'=>'required|file|mimes:pdf,docx|max:2125',
            'submission_date'=>'required|date'
        ]);
        $input=$request->except('file','submission_date','_token');
        $input['teacher_id']=Auth::guard('teacher')->user()->id;
        $input['class_id']=$request->class;
        $input['section_id']=$request->section;
        $input['submitted_till']=$request->submission_date;
        if($request->hasFile('file')){ 
            $uploadedFile = $request->file('file');
            if ($uploadedFile->isValid()) {
                $input['file']=FileUpload::file($request,'file','uploads/assignments');
                 }
        }
        $input=Assignment::create($input);
        $link=route('teacher.assignments.show',['assignment'=>$input->id]);
        return redirect()->back()->with(['success'=>'Assignment added successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignment=Assignment::findOrFail($id);
        return view('back.teacher.assignment.view', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes=Stdclass::orderBy('order')->get();
        $assignment=Assignment::findOrFail($id);
        if($assignment->teacher_id != Auth::guard('teacher')->user()->id){
            abort('403');
        }
        return view('back.teacher.assignment.edit', compact('assignment','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $assignment=Assignment::findOrFail($id);
        if($assignment->teacher_id != Auth::guard('teacher')->user()->id){
            abort('403');
        }
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'class'=>'required',
            'file'=>'nullable|file|mimes:pdf,docx|max:2125',
            'submission_date'=>'required|date'
        ]);
        $input=$request->except('file','submission_date','_token');
        $input['class_id']=$request->class;
        $input['section_id']=$request->section;
        $input['submitted_till']=$request->submission_date;
        if($request->remfile){
            $input['file']=null;
            //deleting image
            if($assignment->file && File::exists($assignment->file)){
                unlink($assignment->file);
                $assignment->file=null;
            }
        }
        if($request->hasFile('file')){ 
            $uploadedFile = $request->file('file');
            if ($uploadedFile->isValid()) {
                $input['file']=FileUpload::file($request,'file','uploads/assignments');
                 }

                 if($assignment->file && File::exists($assignment->file)){
                    unlink($assignment->file);
                }
        }
        $input=$assignment->update($input);
        $link=route('teacher.assignments.show',['assignment'=>$assignment->id]);
        return redirect()->back()->with(['success'=>'Assignment added successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment=Assignment::findOrFail($id);
        if($assignment->teacher_id != Auth::guard('teacher')->user()->id){
            abort('403');
        }
        
        if($assignment->file && File::exists($assignment->file)){
            unlink($assignment->file);
        }
        return redirect()->back()->with(['success'=>'Assignment deleted successfully']);
    }
}
