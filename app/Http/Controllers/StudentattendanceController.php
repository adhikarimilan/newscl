<?php

namespace App\Http\Controllers;

use App\Studentattendance;
use Illuminate\Http\Request;
use App\Stdclass;
use App\Student;
use Session;

class StudentattendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $classes=Stdclass::where('active','1')->orderBy('order')->get();
        $reqdate=false;
        if(request()->y && request()->m){
            $reqdate=date_create(request()->y.'-'.request()->m);
            if($reqdate)
            $reqdate=date_format($reqdate,"Y-m-");
        }
        else $reqdate=false;
        if(request()->class && request()->section)
        $students = Student::with('stdattendance')->whereHas('stdattendance', function ($query) use ($reqdate) {
            $date=$reqdate ? $reqdate :date("Y-m-");
            //dd($date);
            $query->where('created_at','like', $date.'%')
                ->where('class_id', request()->class)
                ->where('section_id',request()->section);
        });
        else if(request()->class && !request()->section)
        $students = Student::with('stdattendance')->whereHas('stdattendance', function ($query) use ($reqdate) {
            $date=$reqdate ? $reqdate :date("Y-m-");
            $query->where('created_at','like', $date.'%')
                ->where('class_id', request()->class);
        });
        else
        return view('back.admin.sattendance.show')->with(['statuserr'=>'please select class','classes'=>$classes]);

       
        //dd($products->get());
        $students=$students->where('active','1')->orderBy('roll_no')->get();
        //$students=$students->get();
        //dd($students);
        $d=0;
        if($reqdate){
            $d=cal_days_in_month(CAL_GREGORIAN,request()->m,request()->y);
        }
        return view('back.admin.sattendance.show')->with(['students'=>$students,'classes'=>$classes,'reqdate'=>$reqdate,'d'=>$d]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date=date("Y-m-d");
        $classes=Stdclass::where('active','1')->orderBy('order')->get();
        $students = [];
        if(request()->class && request()->section){
        $attendances=Studentattendance::where('created_at','like',$date.'%')->where('class_id', request()->class)
        ->where('section_id',request()->section)->get();
        $students = Student::where('active','1')->where('class_id', request()->class)
        ->where('section_id',request()->section)->orderBy('roll_no');
    }
        else if(request()->class && !request()->section){
        $attendances=Studentattendance::where('created_at','like',$date.'%')->where('class_id', request()->class)->get();
        $students = Student::where('active','1')->where('class_id', request()->class)->orderBy('roll_no');
    }
        else
        return view('back.admin.sattendance.create')->with(['error'=>'please select class','classes'=>$classes]);
        
        
        //dd($products->get());
        //$teachers=Teacher::where('active','1')->orderBy('order')->get();
        
        $students=$students->get();
        //dd($students);
        if(count($attendances)){
            $success="Students attendance for today has been registered already click enable edit to edit this attendance";
        return view('back.admin.sattendance.view')->with(['success'=>$success,'students'=>$students,'classes'=>$classes]);
        }
//         $from = date('2020-07-21');
// $to = date("Y-m-d H:i:s");
// $attendances=Teacherattendance::whereBetween('created_at', [$from, $to])->get();
//         dd($attendances);
        
        //dd($teachers->tattendance);
       // $students = Student::where('active','1')->orderBy('roll_no')->get();
        return view('back.admin.sattendance.create',compact('students','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $present=$input['present'];
        $tid=$input['tid'];
        $ip=[];
        for($i=0;$i<count($tid);$i++){
            $ip['present']=$present[$i];
            $std=Student::find($tid[$i]);
            if(!$std) continue;
            $ip['student_id']=$tid[$i];
            $ip['class_id']=$std->class_id;
            $ip['section_id']=$std->section_id;
            $input=Studentattendance::create($ip); 
        }
        return redirect()->back()->with('success','Student attendance created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Studentattendance  $studentattendance
     * @return \Illuminate\Http\Response
     */
    public function show(Studentattendance $studentattendance)
    {
        if(request()->class && request()->section)
        $students = Student::with('stdattendance')->whereHas('stdattendance', function ($query) {
            $date=date("Y-m-d");
            $query->where('created_at','like', $date.'%')
                ->where('class_id', request()->class)
                ->where('section_id',request()->section);
        });
        else if(request()->class && !request()->section)
        $students = Student::with('stdattendance')->whereHas('stdattendance', function ($query) {
            $date=date("Y-m-d");
            $query->where('created_at','like', $date.'%')
                ->where('class_id', request()->class)
                ->where('section_id',request()->section);
        });
        else
        $students=Student::where('gender','8')->orderBy('roll_no');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Studentattendance  $studentattendance
     * @return \Illuminate\Http\Response
     */
    public function edit($studentattendance)
    {
        $students = Student::with('stdattendance')->whereHas('stdattendance', function ($query) {
            $date=date("Y-m-d");
            $query->where('created_at','like', $date.'%');
        });
        //dd($products->get());
        //$teachers=Teacher::where('active','1')->orderBy('order')->get();
        $students=$students->where('active','1')->orderBy('roll_no')->get();
        return view('back.admin.sattendance.edit',compact('students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Studentattendance  $studentattendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $studentattendance)
    {
        $input=$request->except('_token');
        $present=$input['present'];
        $taid=$input['taid'];
        $ip=[];
        for($i=0;$i<count($taid);$i++){
            $attendance=Studentattendance::findOrFail($taid[$i]);
            $ip['present']=$present[$i];
            $input=$attendance->update($ip); 
        }
        return redirect()->back()->with('success','Teacher attendance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Studentattendance  $studentattendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentattendance $studentattendance)
    {
        //
    }
}
