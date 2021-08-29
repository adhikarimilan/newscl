<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\FileUpload;
use File;
use App\Message;

class TeacherController extends Controller
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

        $teachers=Teacher::orderBy('order')->get();
       // $teachers=[];
        return view('back.admin.teacher.index', compact('teachers','msgs','unseen'));
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

        return view('back.admin.teacher.create',compact('msgs','unseen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'bail|required|unique:teachers',
            'contact'=>'bail|required|min:8|unique:teachers',
            'per_address'=>'required',
            'temp_address'=>'required',
            'password'=>'nullable|min:8',
            'active'=>'required',
        ]);
        
        $input=$request->except('_token','password');
        if($request->pass && $request->password){
            $input['password']=Hash::make($request->password);
        }
        
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['avatar']=FileUpload::photo($request,'pic','','uploads/teachers',500,500);
                 }
        }
        $input=Teacher::create($input);
        $link=route('teachers.show',['teacher'=>$input->id]);
        return redirect()->back()->with(['success'=>'Teacher added successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $teacher=Teacher::findOrFail($id);
        return view('back.admin.teacher.view', compact('teacher','msgs','unseen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $teacher=Teacher::findOrFail($id);
        return view('back.admin.teacher.edit', compact('teacher','msgs','unseen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request,[
            'name'=>'required',
            'gender'=>'required',
            'email'=>'bail|required|email',
            'contact'=>'required',
            'per_address'=>'required',
            'temp_address'=>'required',
            'password'=>'nullable|min:8',
            'active'=>'required',
            'contact'=>'bail|required|min:8'
        ]);
        $teacher=Teacher::findOrFail($id);
        $mail=Teacher::where('email',$request->email)->first();
        if($mail && $mail->id!=$teacher->id)
        return redirect()->back()->with('error','This email ('.$request->email.') belongs to another teacher');
        $input=$request->except('_token','password');
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
        $link=route('teachers.show',['teacher'=>$teacher->id]);
        return redirect()->back()->with(['success'=> 'Teacher account info updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher=Teacher::findOrFail($id);
        if($teacher->avatar)
        if(File::exists($teacher->avatar))
        unlink($teacher->avatar);
        $teacher->delete(); 
        return redirect(route('teachers.index'))->with('success', 'Teacher account deleted successfully');
    }

    public function takeattendance()
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;

        $date=date("Y-m-d");
        $attendances=Teacherattendance::where('created_at','like',$date.'%')->get();
        $teachers = Teacher::with('tattendance')->whereHas('tattendance', function ($query) {
            $date=date("Y-m-d");
            $query->where('created_at','like', $date.'%');
        });
        $teachers=$teachers->get();
        if(count($attendances))
        return view('back.admin.tattendance.view',compact('teachers','msgs','unseen'));
        
        return view('back.admin.tattendance.create',compact('teachers','msgs','unseen'));
    }
}
