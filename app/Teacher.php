<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\customResetPassword;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $table='teachers';
    protected $fillable=[
        'name','gender','per_address','temp_address','education','faculty','avatar','post','type','active','email','password','contact','dob_bs','dob_ad'
    ];

    public function class(){
        return $this->hasOne('\App\Stdclass', 'class_teacher_id');
    }
    public function tattendance(){
        return $this->hasMany('\App\Teacherattendance', 'teacher_id');
    }
    public function ttattendance(){
        return $this->hasMany('\App\Teacherattendance', 'teacher_id')->orderBy('created_at','desc')->limit(1);
    }
    public function sendPasswordResetNotification($token) {
        $url=url('teacher/password/reset/');
        $this->notify(new customResetPassword($token,$url));
    }
}
