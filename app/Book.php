<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['title','pic','author','stock','rack_no','category_id','purchased_at'];

    public function issued(){
        return $this->hasMany('\App\Issuebook', 'book_id');
    }
    public function category(){
        return $this->belongsTo('\App\Bookcategories', 'category_id');
    }
}
