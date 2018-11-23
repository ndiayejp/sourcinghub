<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public static function cleanCaracteresSpeciaux ($chaine)
        {
            setlocale(LC_ALL, 'fr_FR');

            $chaine = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $chaine);

            $chaine = preg_replace('#[^0-9a-z]+#i', '-', $chaine);

            while(strpos($chaine, '--') !== false)
            {
                $chaine = str_replace('--', '-', $chaine);
            }

            $chaine = trim($chaine, '-');

            return $chaine;
        }
}