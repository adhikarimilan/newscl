<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Stdparent;
use App\Stdclass;
use App\Student;
use App\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\FileUpload;
use File;


class StdparentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents=Stdparent::get();
        return view('back.teacher.parents.index')->with('parents',$parents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes=Stdclass::orderBy('order')->get();
        return view('back.teacher.parents.create', compact('classes'));
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
            'email'=>'bail|required|unique:parents',
            'address'=>'nullable',
            'password'=>'nullable|min:8',
            'active'=>'required',
            'contact'=>'bail|nullable|min:8'
        ]);
        
        $input=$request->except('_token');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/parents',500,500);
                 }
        }
        $input=Stdparent::create($input);
        $link=route('teacher.parents.show',['parent'=>$input->id]);
        return redirect()->back()->with(['success'=>'Parent added successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stdparent  $stdparent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent=Stdparent::findOrFail($id);
        return view('back.teacher.parents.view', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stdparent  $stdparent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent=Stdparent::findOrFail($id);
        $classes=Stdclass::orderBy('order')->get();
        return view('back.teacher.parents.edit', compact('parent','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stdparent  $stdparent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        $link=route('teacher.parents.show',['parent'=>$parent->id]);
        return redirect()->back()->with(['success'=>'Parent details updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stdparent  $stdparent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent=Stdparent::findOrFail($id);
        if($parent->avatar)
        if(File::exists($parent->avatar))
        unlink($parent->avatar);
        $parent->delete();
        return redirect(route('teacher.parents.index'))->with('success','Parent deleted successfully');
    }

    public function addstd(Request $request)
    {
        //dd($request->all());
        // DB::listen(function($e){
        //     dump($e->sql);
        // });
        $parent=Stdparent::findOrFail($request->par);
        if($parent){
            $std=$request->student;
            $relation=$request->relation;
            $reln=$request->reln;

 
            foreach($parent->student_parent as $stdpar){
                if($std){
                $found=0;
                for($i=0;$i<count($std);$i++){
                    if($stdpar->student->id == $std[$i] && $stdpar->stdparent->id == $parent->id){
                        \array_splice($std,$i,1);
                         \array_splice($relation,$i,1);
                         \array_splice($reln,$i,1);
                        $found=1;
                        break;
                    }
                }
                if($found!='1'){
                    $stdpar->delete();
                }
            }
            else $stdpar->delete();
            }

            if($std && count($std)){
            for($i=0;$i<count($std);$i++)
            {
                
                $student=Student::find($std[$i]);
                $stdpar=StudentParent::where(['parent_id'=>$request->par,'student_id'=>$std[$i]])->get();
                $input=[];
                if($student && !count($stdpar)){
                    $input['parent_id']=$request->par;
                    $input['student_id']=$std[$i];
                    if($relation[$i]=="1"){
                        $input['relation']=$reln[$i]; 
                    }
                    else
                    $input['relation']=$relation[$i]; 
                $input=StudentParent::create($input);
                }
            }
        }
        }
        //dd(memory_get_peak_usage()/1024/1024 ." mb ".memory_get_usage()/1024/1024);
        return redirect()->back()->with(['success'=>'Parent child details updated successfully']);
    }
}
