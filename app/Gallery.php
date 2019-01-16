<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //

    protected $fillable = [
        'name','user_id'
    ];


    public function User(){
        return $this->belongsTo('App\User');
    }
}
