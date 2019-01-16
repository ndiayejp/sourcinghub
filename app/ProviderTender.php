<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderTender extends Model
{
    //

    protected $fillable = [
        'email'
    ];

    protected $table = "provider_tenders";

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}
