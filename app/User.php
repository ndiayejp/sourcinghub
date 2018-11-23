<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\ImageManagerStatic;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmation_token',
        'firstname', 'lastname','avatar'
    ];

    protected $table = 'users';


    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password'  =>'required|string|min:6|confirmed',
        'phone'=>'required'
    ];  



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Accessors
     */

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function getAvatarAttribute($avatar){
        if($avatar){
            return "img/avatars/{$this->id}.jpg";
        }
        return false;
    }
    public function setAvatarAttribute($avatar){
        if (is_object($avatar)&& $avatar->isValid()) {
            ImageManagerStatic::make($avatar)->fit(150,150)->save("img/avatars/{$this->id}.jpg");
        }
        $this->attributes['avatar'] = true;
    }

    /*
    Functions
    */

    public function hasProfile($id)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->user_id == $id) {
                return $profile->name;
            }
        }
     }

     /**
     * Relations
     */

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function favorite_posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function companies()
    {
        return $this->hasMany('App\Company');
    }


    public function Proposal(){
        return $this->belongsTo('App\Proposal');
    }

    public function Reply(){
        return $this->belongsTo('App\Reply');
    }

    
    public function assigns(){
        return $this->hasMany('App\Assign');
    }



    
}
