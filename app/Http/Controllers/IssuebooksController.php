<?php

namespace App\Http\Controllers;

use App\Issuebook;
use Illuminate\Http\Request;
use App\Book;
use App\Stdclass;
use Carbon\Carbon;


class IssuebooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookissues=Issuebook::get();
        return view('back.admin.bookissues.index',compact('bookissues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books=Book::get();
        $classes=Stdclass::orderBy('order')->get();
        return view('back.admin.bookissues.create',compact('books','classes'));
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
            'book'=>'required|numeric',
            'student'=>'required|numeric',
            'return_bef'=>'required|date',
        ]);
        $input=$request->except('_token');
        $bookissue=Issuebook::where(['student_id'=>$input['student'],'book_id'=>$input['book'],'returned'=>0]);
        if($bookissue)
        return redirect()->back()->with(['error'=>'Book Issued already to the same student ']);
        $input['student_id']=$input['student'];
        $input['book_id']=$input['book'];
        $input['issued_at'] = Carbon::now()->toDateTimeString(); 
        $input=Issuebook::create($input);
        $link=route('bookissues.show',['bookissue'=>$input->id]);
        return redirect()->back()->with(['success'=>'Book Issue record created successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issuebooks  $issuebooks
     * @return \Illuminate\Http\Response
     */
    public function show($issuebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issuebooks  $issuebooks
     * @return \Illuminate\Http\Response
     */
    public function edit( $issuebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issuebooks  $issuebooks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $issuebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issuebooks  $issuebooks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input=Issuebook::findOrFail($id);
        $input->delete();
        return redirect()->back()->with(['success'=>'Book Issue record marked as returned successfully']);
    }
}
