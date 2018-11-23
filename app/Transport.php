<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    //

     /**
     * Relations
     */

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
