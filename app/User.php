<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Notifications\Notifiable;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    use Rateable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'email', 'password','confirmation_token','firstname', 'lastname','avatar'];

    protected $table = 'users';

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

    public function getFullNameAttribute(){
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
    public function hasProfile($id){
        foreach ($this->profiles as $profile) {
            if ($profile->user_id == $id) {
                return $profile->name;
            }
        }
    }
    /**
    * Relations
    */
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function favorite_posts(){
        return $this->belongsToMany('App\Post')->withTimestamps();
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function companies(){
        return $this->hasMany('App\Company');
    }

    public function Proposal(){
        return $this->belongsTo('App\Proposal');
    }

    public function tenders(){
        return $this->hasMany('App\Tender');
    }

    public function Reply(){
        return $this->belongsTo('App\Reply');
    }
    
    public function assigns(){
        return $this->hasMany('App\Assign');
    }
    
}
