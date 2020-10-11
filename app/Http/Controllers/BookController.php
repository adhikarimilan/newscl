<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Bookcategories;
use App\FileUpload;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::get();
        return view('back.admin.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Bookcategories::get();
        return view('back.admin.books.create',compact('categories'));
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
            'title'=>'required',
            'author'=>'required',
            'stock'=>'required',
        ]);
        
        $input=$request->except('_token','pic');
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['pic']=FileUpload::photo($request,'pic','','uploads/books',500,500);
                 }
        }
        $input=Book::create($input);
        $link=route('books.show',['book'=>$input->id]);
        return redirect()->back()->with(['success'=>'Book added successfully','link'=>$link]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::findOrFail($id);
        return view('back.admin.books.view',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=Book::findOrFail($id);
        $categories=Bookcategories::get();
        return view('back.admin.books.edit',compact('categories','book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book=Book::findOrFail($id);
        $this->validate($request,[
            'title'=>'required',
            'author'=>'required',
            'stock'=>'required',
            'purchased_at'=>'required',
        ]);
        
        $input=$request->except('_token','pic');
        if($request->rempic){
            $input['pic']= null;
            //deleting image
            if($book->pic && File::exists($book->pic)){
                unlink($book->pic);
                $book->pic=null;
            }
        }
        if($request->hasFile('pic')){ 
            $uploadedFile = $request->file('pic');
            if ($uploadedFile->isValid()) {
                $input['pic']=FileUpload::photo($request,'pic','','uploads/books',500,500);
                 }
                 if($book->pic && File::exists($book->pic)){
                    unlink($book->pic);
                }
        }
        $input=$book->update($input);
        $link=route('books.show',['book'=>$book->id]);
        return redirect()->back()->with(['success'=>'Book updated successfully','link'=>$link]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
