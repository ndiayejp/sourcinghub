<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    //

    protected  $fillable = ['price','post_id','user_id','item_id'];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }

    public function Item(){
        return $this->belongsTo('App\Item');
    }

    public function User(){
        return $this->belongsTo('App\User');
    }
}
