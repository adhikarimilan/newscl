<?php

namespace App\Http\Controllers;

use App\Stdparent;
use App\Stdclass;
use App\Student;
use App\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\FileUpload;
use File;
use App\Message;


class StdparentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $msgs;
    private $unseen;
    public function msgs(){
        $this->msgs=Message::orderBy('created_at','desc')->limit(4)->get();

        $this->unseen=count(Message::where('seen','=','0')->get());
    }


    public function index()
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $parents=Stdparent::get();
        return view('back.admin.parents.index',compact('parents','msgs','unseen'));


        $par=Stdparent::findOrFail('1');
        $std=$par->student_parent->first()->student->name;
        dd($std);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $classes=Stdclass::orderBy('order')->get();
        return view('back.admin.parents.create', compact('classes','msgs','unseen'));
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
        }else $input['password']=null;
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/parents',500,500);
                 }
        }
        $parent=Stdparent::create($input);
        $link=route('parents.show',['parent'=>$parent->id]);

        $std=$request->student;
        $relation=$request->relation;
        $reln=$request->reln;

        if($std && count($std)){
            for($i=0;$i<count($std);$i++)
            {
                
                $student=Student::find($std[$i]);
                $stdpar=StudentParent::where(['parent_id'=>$parent->id,'student_id'=>$std[$i]])->get();
                $input=[];
                if($student && !count($stdpar)){
                    $input['parent_id']=$parent->id;
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
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $parent=Stdparent::findOrFail($id);
        return view('back.admin.parents.view', compact('parent','msgs','unseen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stdparent  $stdparent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $parent=Stdparent::findOrFail($id);
        $classes=Stdclass::orderBy('order')->get();
        return view('back.admin.parents.edit', compact('parent','classes','msgs','unseen'));
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
        $link=route('parents.show',['parent'=>$parent->id]);
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
        return redirect(route('parents.index'))->with('success','Parent deleted successfully');
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
                //implementing one parent account  for a student 
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
