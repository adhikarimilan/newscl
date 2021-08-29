<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schoolevent;
use App\Fileupload;
use File;
use App\Message;

class SchooleventController extends Controller
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
        $events=Schoolevent::orderBy('created_at')->get();
         return view('back.admin.events.index', compact('events','msgs','unseen'));
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
        return view('back.admin.events.create', compact('msgs','unseen'));
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
            'pic'=>'nullable|image',
            'file'=>'nullable|mimes:pdf,docx',
        ]);
        
        $input=$request->except('_token');
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['pic']=FileUpload::photo($request,'pic','','uploads/events',1020,1024);
                 }
        }
        if($request->hasFile('file')){ 
            $uploadedFile = $request->file('file');
            if ($uploadedFile->isValid()) {
                $input['file']=FileUpload::file($request,'file','uploads/events','event');
                 }
        }
        $input=Schoolevent::create($input);
        
        return redirect()->back()->with('success','Event added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
       $event=Schoolevent::findOrFail($id);
       return view('back.admin.events.view', compact('event','msgs','unseen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $event=Schoolevent::findOrFail($id);
        return view('back.admin.events.edit', compact('event','msgs','unseen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event=Schoolevent::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'pic'=>'nullable|image',
            'file'=>'nullable|mimes:pdf,docx',
        ]);
        $input=$request->except('_token','password');
        
        if($request->rempic){
            //dd('inside');
            $input['pic']=null;
            //deleting image
            if($event->pic && File::exists($event->pic)){
                unlink($event->pic);
                $event->pic=null;
            }
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['pic']=FileUpload::photo($request,'pic','','uploads/events',500,500);
                 }
                 if($event->pic && File::exists($event->pic)){
                    unlink($event->pic);
                }
        }
        if($request->remfile){
            //dd('inside');
            $input['file']=null;
            //deleting image
            if($event->file && File::exists($event->file)){
                unlink($event->file);
                $event->file=null;
            }
        }
        if($request->hasFile('file')){ 
            $uploadedFile = $request->file('file');
            if ($uploadedFile->isValid()) {
                $input['file']=FileUpload::file($request,'file','uploads/events','event');
                 }
                 if($event->file && File::exists($event->file)){
                    unlink($event->file);
                }
        }

        $input=$event->update($input);
        $link=route('events.show',['event'=>$event->id]);
        return redirect()->back()->with(['success'=>'Event details updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Schoolevent::findOrFail($id);
        if($event->pic)
        if(File::exists($event->pic))
        unlink($event->pic);
        $event->delete();
        if($event->file)
        if(File::exists($event->file))
        unlink($event->file);
        $event->delete();
        return redirect(route('events.index'))->with('success','event deleted successfully');
    }
}
