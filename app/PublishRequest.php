<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PublishRequest
 *
 * @package App
 * @property string $player_movie
 * @property tinyInteger $is_published
*/
class PublishRequest extends Model
{
    use SoftDeletes;

    protected $fillable = ['is_published', 'player_movie_id','published_to_movie_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPlayerMovieIdAttribute($input)
    {
        $this->attributes['player_movie_id'] = $input ? $input : null;
    }
    
    public function player_movie()
    {
        return $this->belongsTo(PlayerMovie::class, 'player_movie_id')->withTrashed();
    }

    public function published_to()
    {
        return $this->belongsTo(Movie::class, 'published_to_movie_id')->withTrashed();
    }
}
