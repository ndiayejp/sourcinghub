<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incoterm extends Model
{
    //

    protected  $fillable = ['name'];
    protected $table  = "incoterms";


    public static $rules = [

        'name'  => 'required|unique:incoterms',
        'code'  => 'required'
    ];

     /**
     * Relations
     */

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }
}
