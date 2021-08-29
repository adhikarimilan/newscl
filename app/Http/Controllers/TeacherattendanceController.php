<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Teacherattendance;
use Session;
use App\Message;

class TeacherattendanceController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  
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

        $reqdate=false;
        if(request()->y && request()->m){
            $reqdate=date_create(request()->y.'-'.request()->m);
            if($reqdate)
            $reqdate=date_format($reqdate,"Y-m-");
        }
        else $reqdate=false;
        $teachers = Teacher::with('tattendance')->whereHas('tattendance', function ($query) use ($reqdate) {
            $date=$reqdate ? $reqdate :date("Y-m-");
            $query->where('created_at','like', $date.'%');
        });
        //dd($products->get());
        //$teachers=Teacher::where('active','1')->orderBy('order')->get();
        $teachers=$teachers->get();
        $d=0;
        if($reqdate){
            $d=cal_days_in_month(CAL_GREGORIAN,request()->m,request()->y);
        }
        return view('back.admin.tattendance.show')->with(['teachers'=>$teachers,'d'=>$d,'reqdate'=>$reqdate,'msgs'=>$msgs,'unseen'=>$unseen]);
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //dd($attendances);
        //$teachers=Teacher::where('active','1')->orderBy('order')->get();
        $teachers=$teachers->get();
        if(count($attendances)){
            $success="Teachers attendance for today has been registered already click enable edit to edit this attendance";
        return view('back.admin.tattendance.view')->with(['success'=>$success,'teachers'=>$teachers,'msgs'=>$msgs,'unseen'=>$unseen]);
        }
//         $from = date('2020-07-21');
// $to = date("Y-m-d H:i:s");
// $attendances=Teacherattendance::whereBetween('created_at', [$from, $to])->get();
//         dd($attendances);
        
        //dd($teachers->tattendance);
        $teachers=Teacher::where('active','1')->orderBy('order')->get();
        return view('back.admin.tattendance.create',compact('teachers','msgs','unseen'));
    }

    
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $present=$input['present'];
        $tid=$input['tid'];
        $ip=[];
        for($i=0;$i<count($tid);$i++){
            $ip['present']=$present[$i];
            $ip['teacher_id']=$tid[$i];
            $input=Teacherattendance::create($ip); 
        }
        return redirect()->back()->with('success','Teacher attendance created successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   
    public function edit($teacherattendance)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        
        //Session::forget('success');
        $teachers = Teacher::with('tattendance')->whereHas('tattendance', function ($query) {
            $date=date("Y-m-d");
            $query->where('created_at','like', $date.'%');
        });
        //dd($products->get());
        //$teachers=Teacher::where('active','1')->orderBy('order')->get();
        $teachers=$teachers->where('active','1')->orderBy('order')->get();
        return view('back.admin.tattendance.edit',compact('teachers','msgs','unseen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teacherattendance)
    {
        $input=$request->except('_token');
        $present=$input['present'];
        $taid=$input['taid'];
        $ip=[];
        for($i=0;$i<count($taid);$i++){
            $attendance=Teacherattendance::findOrFail($taid[$i]);
            $ip['present']=$present[$i];
            $input=$attendance->update($ip); 
        }
        return redirect()->back()->with('success','Teacher attendance updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
