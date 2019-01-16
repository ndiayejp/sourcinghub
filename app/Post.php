<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'name','slug','description','active','categories',
        'company_id','user_id','closing_date',
        'delivery_date','payment_method',
        'offer_in_device','address_delivery','budget',
        'incoterm_id','country_id','city_id','state_id','opens'
    ];

    public static $rules = [
        'name'=>'required|max:255',
        'description'=>'required',
        'company_id'=>'required|integer',
        'closing_date'=>'required',
        'delivery_date'=>'required|after:closing_date',
        'payment_method'=>'required',
        'offer_in_device'=>'required',
        'address_delivery'=>'required',
        'country_id'=>'required|integer',
        'item_description'=>'required',
        'state_id'=>'required',
        'incoterm_id'=>'required'
    ];

    /**
    *  Functions
    **/

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        } else {
            $excerpt = $str;
        }
        return $excerpt;
    }

    function random_str($nbr) {
        $str = "";
        $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ";
        $nb_chars = strlen($chaine); 
        for($i=0; $i<$nbr; $i++)
        {
            $str .= $chaine[ rand(0, ($nb_chars-1)) ];
        }

        return $str;
    }

    /**
     * Accessors
    */


    public function scopePublished($query){
    	return $query->where('active',true);
    }

    public function scopeInProgress($query, $type){
        return $query->whereHas('state', function ($q) use ($type) {
            $q->where('url_state', 'en-cours');
        });
    	return $query->where('url_state', $type);
    }


    public function scopeLastestFirst($query){
       return $query->orderBy('created_at','desc');
    }

    /**
    * Relations
    */

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function Company(){
        return $this->belongsTo('App\Company');
    }

    public function state(){
        return $this->belongsTo('App\State');
    }

    public function opens(){
        return $this->belongsToMany('App\Open');
    }

    public function Incoterm(){
        return $this->belongsTo('App\Incoterm');
    }

    public function Country(){
        return $this->belongsTo('App\Country');
    }

    public function Items(){
        return $this->hasMany('App\Item');
    }

    public function files(){
        return $this->hasMany('App\File');
    }

    public function favorite_to_users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function Proposals(){
        return $this->hasMany('App\Proposal');
    }


    public function assigns(){
        return $this->hasMany('App\Assign');
    }

    public function Replies(){
        return $this->hasMany('App\Reply');
    }

    

   
}
