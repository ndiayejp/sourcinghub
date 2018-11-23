<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //

    protected  $fillable = ['name','url_state'];
    protected $table  = "states";

 
 
    

    public static $rules = [

        'name'  => 'required|unique:states',
 
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
