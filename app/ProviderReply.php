<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderReply extends Model
{
    //

    protected $table = "provider_reply";

    protected $fillable = [
        'tender_id',
        'user_id',
        'price',
        'body',
        'file',
        'delivery',
        'product_id'
    ];


    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Product()
    {
        return $this->belongsTo('App\ProductTender');
    }


}
