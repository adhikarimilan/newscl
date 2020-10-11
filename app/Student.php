<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table='students';
    protected $fillable=[
        'name','gender','roll_no','per_address','temp_address','avatar','active','bio','email','class_id','section_id','avatar','faculty','password','contact','dob_bs','dob_ad'
    ];
    protected $hidden=['password'];
    public function class(){
            return $this->belongsTo('\App\Stdclass', 'class_id');
    }
    public function section(){
        return $this->belongsTo('\App\Section', 'section_id');
    }
    public function stdattendance(){
        return $this->hasMany('\App\Studentattendance', 'student_id');
    }
    public function tstdattendance(){
        return $this->hasMany('\App\Studentattendance', 'student_id')->orderBy('created_at','desc')->limit(1);
    }
    public function stdparent(){
        return $this->hasMany('\App\Stdparent', 'student_id');
    }
    public function student_parent(){
        return $this->hasMany('App\StudentParent','student_id');
    }
    public function issuedbooks(){
        return $this->hasMany('App\Issuebook','student_id');
    }
}
