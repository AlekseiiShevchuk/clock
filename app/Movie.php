<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Movie
 *
 * @package App
 * @property string $name
 * @property string $description
 * @property string $movie_file
 * @property string $original_movie_file
 * @property string $answer
 * @property string $level
 * @property string $language
*/
class Movie extends Model implements HasMovieFileContract
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'movie_file', 'answer', 'level_id', 'language_id'];

    public function getMovieFileName()
    {
        return $this->movie_file;
    }

    public function setMovieFileName($name)
    {
        $this->movie_file = $name;
        $this->save();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLevelIdAttribute($input)
    {
        $this->attributes['level_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLanguageIdAttribute($input)
    {
        $this->attributes['language_id'] = $input ? $input : null;
    }

    public function setNameAttribute($input)
    {
        $this->attributes['name'] = $input ? $input : 'no name';
    }
    
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id')->withTrashed();
    }
    
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withTrashed();
    }
    
}
