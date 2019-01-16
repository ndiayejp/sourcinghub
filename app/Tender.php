<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tender extends Model
{
    
    use Notifiable;

    protected $fillable = [
        'tender_date',
        'name', 'body','type','offer_in_device'
    ];

    public function products(){
        return $this->hasMany(ProductTender::class);
    }

    public function providers(){
        return $this->hasMany(ProviderTender::class);
    }

    public function deals(){
        return $this->hasMany(ProviderReply::class);
    } 

    public function user(){
        return $this->belongsTo('App\User');
    }
}
