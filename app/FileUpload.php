<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Image;
use URL;
class FileUpload extends Model
{
    public static function photo($request,$filename,$default='',$path,$h,$w){
    	
    	$photo=$request->$filename;
    	$name=rand(1111,9999)."-".date('Y-md-d')."-".time().".".$photo->getClientOriginalExtension();

    	$img = Image::make($photo->getRealPath()); 

        $canvas = Image::canvas($h, $w);

        $img->fit($h, $w, function ($constraint) {
            $constraint->upsize();
        });

        $canvas->insert($img, 'center');

    	$canvas->resize($h,$w, function ($constraint) {
    	$constraint->aspectRatio();
    	})->save($path.'/'.$name);

    	return $path.'/'.$name;

        


    }

    public static function file($request,$filename,$path){
    	
    	$file=$request->$filename;
    	$name="assignment".rand(1111,9999)."-".date('Ymd_his').".".$file->getClientOriginalExtension();
        $pathy = $request->file($filename)->move($path, $name);
    	return $path.'/'.$name;

    }
}
