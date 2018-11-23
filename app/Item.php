<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    protected $fillable = [
        'name','description','unit','qte','post_id'
    ];

    public static $rules = [

         'description'=>'required',
         

 
    ];


     /**
     * Relations
     */
    
    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function Proposals(){
        return $this->hasMany('App\Proposal');
    }

    

     
}
