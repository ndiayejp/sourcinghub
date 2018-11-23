<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //

    protected $fillable = [
        'payment','body','file','delivery','post_id',
        'user_id','incoterm_id','amount'
    ];

    protected $table  = "replies";


    public function Incoterm(){
        return $this->belongsTo('App\Incoterm');
    }
    
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


     
}
