<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Stdclass;
use App\Teacher;
use Illuminate\Http\Request;
use App\Section;
use App\Student;
use App\FileUpload;
use File;

class StdclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=Stdclass::orderBy('order')->get();
        return view('back.teacher.classes.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $teachers=Teacher::orderBy('order')->get();//->only('name','id','education')
        // //dd($teachers);
        // return view('back.teacher.classes.create',compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'name'=>'required',
        //     'description'=>'required',
        //     'shift'=>'required',
        // ]);
        
        // $input=$request->except('_token');
        // $input['class_teacher_id']=$request->teacher;
        // if($request->hasFile('pic')){ 
        //     $uploadedFile = $request->file('pic');
        //     if ($uploadedFile->isValid()) {
        //         $input['image']=FileUpload::photo($request,'pic','','uploads/classes',500,500);
        //          }
        // }
        // $input=Stdclass::create($input);
        
        // return redirect()->back()->with('success','Class added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stdclass  $stdclass
     * @return \Illuminate\Http\Response
     */
    public function show($class)
    {
        $class=Stdclass::findOrFail($class);
        return view('back.teacher.classes.view',compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stdclass  $stdclass
     * @return \Illuminate\Http\Response
     */
    public function edit( $class)
    {
        // $class=Stdclass::findOrFail($class);
        // $teachers=Teacher::orderBy('order')->get();
        // //dd($class);
        // return view('back.teacher.classes.edit',compact('class','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stdclass  $stdclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {   //dd($request->all());
    //     $this->validate($request,[
    //         'name'=>'required',
    //         'description'=>'required',
    //         'shift'=>'required',
    //     ]);
    //     $class=Stdclass::findOrFail($id);
    //     $input=$request->except('_token','_method','teacher');
        
    //     $input['class_teacher_id']=$request->teacher;
        
    //     if($request->rempic){
    //         $input['image']=null;
    //         //deleting image
    //         if($class->image && File::exists($class->image)){
    //             unlink($class->image);
    //             $class->image=null;
    //         }
    //     }
    //     if($request->hasFile('pic')){ 
    //         $uploadedFile = $request->file('pic');
    //         if ($uploadedFile->isValid()) {
    //             $input['image']=FileUpload::photo($request,'pic','','uploads/classes',500,500);
    //              }
    //              if($class->image && File::exists($class->image)){
    //                 unlink($class->image);
    //             }
    //     }
    //     $input=$class->update($input);


    //     $secnames=$request->sname;
    //     $secids=$request->sid;
        
    //     foreach($class->sections as $section){
    //         if($secids){
    //         $found=0;
    //         for($i=0;$i<count($secids);$i++){
    //             if($section->id == $secids[$i]){
    //                 $found=1;
    //                 break;
    //             }
    //         }
    //         if($found!='1'){
    //             $section->delete();
    //         }
    //     }
    //     else $section->delete();
    //     }
    //     if($secnames){
    //     for($i=0;$i<count($secnames);$i++){
    //     $input=[];
    //     if($secnames[$i] && $secids[$i]){
    //         $section=Section::where('id',$secids[$i])->where('class_id',$class->id)->first();
    //         //dd($section);
    //         if($section)
    //         {
    //             $input['name']=$secnames[$i];
    //             //$input['class_id']=$class->id;
    //             $section=$section->update($input);
    //         }
    //         else{
    //             $input['name']=$secnames[$i];
    //             $input['class_id']=$class->id;
    //             $input=Section::create($input);
    //         }
    //     }
    //     elseif($secnames[$i]){
    //         $input['name']=$secnames[$i];
    //         $input['class_id']=$class->id;
    //         $input=Section::create($input);
    //     }
    //     else{}
    // }}
    //     return redirect(route('teacher.classes.index'))->with('success','Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stdclass  $stdclass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $class=Stdclass::findOrFail($id);
        // $class->delete();
        // return redirect(route('teacher.classes.index'))->with('success','Class deleted successfully');
    }

    public function getsections(Request $request)
    {
        
        $class=Stdclass::findOrFail($request->cid);
        $data=['data'=>$class->sections];
        return $data;

    }

    public function getstudents(Request $request)
    {
        
        $class=Stdclass::findOrFail($request->cid);
        
        if($request->sid){
            //$students=Student::where('class_id',$request->cid)->where('section_id',$request->sid)->orderBy('roll_no')->get();
            $students=Student::where(['class_id'=>$request->cid,'section_id'=>$request->sid])->orderBy('roll_no')->get();
        }
        else
        {
            $students=Student::where('class_id',$request->cid)->orderBy('roll_no')->get();
        }
        
        $data=['data'=>$students];
        return $data;

    }
}
