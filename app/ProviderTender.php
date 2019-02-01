<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate \Notifications\Notifiable;

 

class ProviderTender extends Model
{
    //

    use Notifiable;

    protected $fillable = [
        'email'
    ];

    protected $table = "provider_tenders";

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}
