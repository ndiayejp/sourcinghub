<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected  $fillable = ['name','url'];

    public static $rules = [

        'name'=>'required|max:255|unique:cities', 
        'country_id'=>'required'
 
    ];

    public function setUrlAttribute($value){
    	if (empty($value)) {
    		$this->attributes['url'] = str_slug($value,'-');
    	}
    }

     /**
     * Relations
     */

    public function Country(){
        return $this->belongsTo('App\Country');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
