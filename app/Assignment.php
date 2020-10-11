<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable=['name','description','class_id','section_id','file','submitted_till','teacher_id'];

    public function class(){
        return $this->belongsTo('\App\Stdclass', 'class_id');
    }
    public function section(){
        return $this->belongsTo('\App\Section', 'section_id');
    }
    public function teacher(){
        return $this->belongsTo('\App\Teacher', 'teacher_id');
    }
}
