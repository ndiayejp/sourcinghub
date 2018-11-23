<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class CategoryPost extends Model
{
    //

 

    protected $table  = "category_post";

    

     /**
     * Relations
     */

    public function category(){
        return $this->hasMany('App\Category');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

     
}
