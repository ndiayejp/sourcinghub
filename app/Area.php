<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
    protected $fillable = ['name', 'url'];
    protected $table = "areas";
    public $timestamps = false;
    public static $rules = ['name' => 'required|unique:areas'];

    /**
    * Relations
    */
    public function posts()
    {
      return $this->hasMany('App\Post');
    }
}
