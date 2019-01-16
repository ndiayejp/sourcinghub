<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTender extends Model
{
    //

    protected $fillable = [
        'name', 'body', 'qte','unit'
    ];
    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function deals(){
        return $this->hasMany('App\ProviderReply','product_id');
    }
}
