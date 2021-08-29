<?php

namespace App\Http\Controllers;

use App\Bookcategories;
use Illuminate\Http\Request;
use App\Message;

class BookcategoriesController extends Controller
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
        $categories=Bookcategories::get();
        return view('back.admin.bookcategories.index',compact('categories','msgs','unseen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required'
        ]);
        
        $input=$request->except('_token');
       
        $input=Bookcategories::create($input);
        $m=1;
        $link=route('bookcategories.show',['bookcategory'=>$input->id]);
        return redirect()->back()->with(['success'=>'Book Category added successfully','link'=>$link,'m'=>$m]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bookcategories  $bookcategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $category=Bookcategories::findOrFail($id);
        dd(json_encode($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bookcategories  $bookcategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->msgs();
        $msgs=$this->msgs;
        $unseen=$this->unseen;
        $category=Bookcategories::findOrFail($id);
        return view('back.admin.bookcategories.edit',compact('category','msgs','unseen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bookcategories  $bookcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category=Bookcategories::findOrFail($id);
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        $input=$request->except('_token');
       
        $input=$category->update($input);
        $link=route('bookcategories.show',['bookcategory'=>$category->id]);
        return redirect()->back()->with(['success'=>'Book Category updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bookcategories  $bookcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $category=Bookcategories::findOrFail($id);
        $category->delete();
        $m=false;
        return redirect()->back()->with(['success'=>'Book Category deleted successfully','m'=>$m]);
    }
}
