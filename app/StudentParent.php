<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
   //table name
   protected $table='student_parent';
   protected $fillable=['parent_id','student_id','relation'];
  

   public function student(){
       return $this->belongsTo('App\Student','student_id');
   }

   public function stdparent(){
       return $this->belongsTo('App\Stdparent','parent_id');
   }

  
}
