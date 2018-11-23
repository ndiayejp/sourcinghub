<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //


    protected  $fillable = ['name','url'];
    
    protected $table  = "activities";


    public static $rules = [

        'name'  => 'required|unique:activities',
 
    ];

    public function profiles(){
        return $this->hasMany('App\Profile');
    }
}
