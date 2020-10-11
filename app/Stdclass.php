<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stdclass extends Model
{
    protected $table='classes';
    protected $fillable=[
        'name','description','shift','active','class_teacher_id','order','image'
    ];

    public function teacher(){
        return $this->belongsTo('\App\Teacher', 'class_teacher_id');
    }

    public function students(){
        return $this->hasMany('\App\Student', 'class_id');
    }

    public function sections()
    {
        return $this->hasMany('\App\Section', 'class_id');
    }

    public function assignments()
    {
        return $this->hasMany('\App\Assignment', 'class_id')->where('submitted_till','>=',date('Y-m-d'));
    }
}

