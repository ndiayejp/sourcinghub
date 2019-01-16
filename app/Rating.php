<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Rating extends Model
{
    //

    protected $fillable = ['rating', 'rateable_id', 'rateable_type', 'user_id'];


    protected $table = "ratings";

    
     // Timestamps
    public $timestamps = false;

    

    /**
     * Relations
     */ 

    public function user()
    {
        return $this->belongsTo('App\User');
    }


     

}
