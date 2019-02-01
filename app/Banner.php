<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = ['name', 'image','end_at','active'];

    protected $table = "banners";

    public function scopePublished($query)
    {
        return $query->where('active', true);
    }

    public function scopeIsValid($query,$date){
        return $query->where('end_at','>',$date);
    }
}
