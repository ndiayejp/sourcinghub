<?php

namespace App;
use Illuminate\{
    Database\Eloquent\Model,
    Notifications\Notifiable
};
 



class Tender extends Model
{

    use Notifiable;

    protected $fillable = [
        'tender_date','name', 'body','type','offer_in_device'
    ];

    public function products(){
        return $this->hasMany('App\ProductTender');
    }

    public function providers(){
        return $this->hasMany('App\ProviderTender');
    }

    public function deals(){
        return $this->hasMany('App\ProviderReply');
    } 

    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
