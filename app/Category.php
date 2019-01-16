<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected  $fillable = ['name','url'];
    protected $table  = "categories";

    public $timestamps = false;

 
    

    public static $rules = [

        'name'  => 'required|unique:categories',
 
    ];

    
    /**
     * Relations
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function profiles(){
        return $this->hasMany('App\Profile');
    }

    

     /**
     * Accessors
     */

    public function getRouteKeyName(){

        return 'url';
    }

    public function setSlugAttribute($value){
    	if (empty($value)) {
    		$this->attributes['url'] = str_slug($value,'-');
    	}
    }

}
