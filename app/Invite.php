<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    //

    use Notifiable;

    protected $fillable = [
        'email','user_id','post_id'
    ];
}
