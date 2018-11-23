<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

     /**
     * Relations
     */

    public function users(){
        return $this->hasMany('App\User');
    }
}
