<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class File extends Model
{
    /**
     * Mass assignment guarded fields
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Relations
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}