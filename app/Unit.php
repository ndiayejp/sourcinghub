<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //

    protected  $fillable = ['name','url_unit','code'];
    protected  $table  = "units";

    public static $rules = [

        'name'  => 'required|unique:units',
 
    ];

}
