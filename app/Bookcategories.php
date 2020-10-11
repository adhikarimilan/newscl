<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookcategories extends Model
{
    protected $fillable=['name','description','slug'];

    public function books(){
        return $this->hasMany('\App\Book', 'category_id');
    }
}
