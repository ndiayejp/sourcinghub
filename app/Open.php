<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Open extends Model
{
    //

    protected  $fillable = ['name','url_open'];
    protected $table  = "opens";

 
 
    

    public static $rules = [

        'name'  => 'required|unique:opens',
 
    ];


    public function posts(){
        return $this->hasMany('App\Post');
    }
}
