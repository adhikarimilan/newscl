<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Stdparent extends Authenticatable
{
    protected $table='parents';
    protected $fillable=[
        'name','gender','address','avatar','active','password','email','contact','occupation'
    ];
    protected $hidden=['password'];

    public function children(){
        return $this->hasMany('\App\Student', 'parent_id');
    }
    public function student_parent(){
        return $this->hasmany('App\StudentParent','parent_id');
    }
}
