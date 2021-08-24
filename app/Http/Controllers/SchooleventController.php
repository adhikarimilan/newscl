<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schoolevent;
use App\Fileupload;
use File;

class SchooleventController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=Schoolevent::orderBy('created_at')->get();
         return view('back.admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.admin.events.create');
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
                $input['file']=FileUpload::file($request,'file','uploads/events');
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
       $event=Schoolevent::findOrFail($id);
       return view('back.admin.events.view', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Schoolevent::findOrFail($id);
        return view('back.admin.events.edit', compact('event'));
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
        //
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
