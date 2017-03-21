<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Level
 *
 * @package App
 * @property string $name
 * @property string $description
 * @property string $language
 */
class Level extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'language_id', 'randomize_movies'];


    /**
     * Set to null if empty
     * @param $input
     */
    public function setLanguageIdAttribute($input)
    {
        $this->attributes['language_id'] = $input ? $input : null;
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withTrashed();
    }

    public function movies()
    {
        if ($this->randomize_movies == 1) {
            return $this->hasMany(Movie::class)->inRandomOrder();
        } else {
            return $this->hasMany(Movie::class);
        }
    }

}
