<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentattendance extends Model
{
    protected $fillable=['class_id','section_id','present','student_id'];
    
    public function students(){
        return $this->hasMany('\App\Student', 'student_id');
    }
    public function stdattendance(){
        return $this->hasMany('\App\Studentattendance', 'student_id');
    }
}
