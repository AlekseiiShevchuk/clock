<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Abuse
 *
 * @package App
 * @property string $player_movie
 * @property string $description
 * @property string $by_player
*/
class Abuse extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'player_movie_id', 'by_player_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPlayerMovieIdAttribute($input)
    {
        $this->attributes['player_movie_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setByPlayerIdAttribute($input)
    {
        $this->attributes['by_player_id'] = $input ? $input : null;
    }
    
    public function player_movie()
    {
        return $this->belongsTo(PlayerMovie::class, 'player_movie_id')->withTrashed();
    }
    
    public function by_player()
    {
        return $this->belongsTo(Player::class, 'by_player_id');
    }
    
}
