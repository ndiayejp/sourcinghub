<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic;

class Company extends Model
{
    //

    protected $fillable = ['name','description','content','address','phone','email','avatarc','user_id'];


    protected $table  = "companies";

     // Primary Key
     public $primaryKey = 'id';
     // Timestamps
     public $timestamps = true;

    public static $rules = [

        'name'=>'required|max:255',
        'avatarc'=>'image',
        'address'=>'required',
        'phone'=>'required',
        'description'=>'required',
        'email'=>'required|email',
 
    ];

     /**
     * Relations
     */

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

     
}
