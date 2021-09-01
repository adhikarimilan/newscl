<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolevent extends Model
{
    protected $table='schoolevents';
    protected $fillable=[
        'name','description','pic','file','active','event_date'
    ];
}
