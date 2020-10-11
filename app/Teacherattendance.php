<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacherattendance extends Model
{
   protected $fillable = ['teacher_id','present'];
}
