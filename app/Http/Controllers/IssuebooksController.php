<?php

namespace App\Http\Controllers;

use App\Issuebook;
use Illuminate\Http\Request;
use App\Book;
use App\Stdclass;
use Carbon\Carbon;
use App\Message;


class IssuebooksController extends Controller
{
    
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
        $bookissues=Issuebook::get();
        return view('back.admin.bookissues.index',compact('bookissues','msgs','unseen'));
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
        $books=Book::get();
        $classes=Stdclass::orderBy('order')->get();
        return view('back.admin.bookissues.create',compact('books','classes','msgs','unseen'));
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

        $bookissue=Issuebook::where(['student_id'=>$input['student'],'book_id'=>$input['book'],'returned'=>0])->get();
        if(count($bookissue))
        return redirect()->back()->with(['error'=>'Book Issued already to the same student and has not been returned ']);

        $bookissueno=Issuebook::where(['book_id'=>$input['book'],'returned'=>0])->count();
        $book=Book::find($input['book']);
        if(!$book)
        return redirect()->back()->with(['error'=>'Book not found']);
        $booktotno=$book->stock;
        $bookavailable=$booktotno-$bookissueno;
        if($bookavailable<1)
        return redirect()->back()->with(['error'=>'Book stock not available']);
        
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
