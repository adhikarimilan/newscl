<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issuebook extends Model
{
    public $timestamps = false;
    protected $table='issuebooks';
    protected $fillable=['student_id','teacher_id','isteacher','book_id','issued_at','return_bef','returned'];
    
    public function student(){
        return $this->belongsTo('\App\Student', 'student_id');
    }
    public function teacher(){
        return $this->belongsTo('\App\Teacher', 'teacher_id');
    }
    public function book(){
        return $this->belongsTo('\App\Book', 'book_id');
    }
}
