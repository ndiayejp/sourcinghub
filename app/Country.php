<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //

    protected  $fillable = ['name','url'];


    public static $rules = [

        'name'=>'required|max:255|unique:countries', 
 
    ];

     /**
     * Relations
     */


    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function profiles(){
        return $this->hasMany('App\Profile');
    }
     

  
}
