<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PlayerMovieCollection
 *
 * @package App
 * @property string $player
 * @property string $language
 * @property string $name
 * @property string $description
*/
class PlayerMovieCollection extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'player_id', 'language_id'];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPlayerIdAttribute($input)
    {
        $this->attributes['player_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLanguageIdAttribute($input)
    {
        $this->attributes['language_id'] = $input ? $input : null;
    }
    
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
    
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withTrashed();
    }

    public function movies()
    {
        return $this->hasMany(PlayerMovie::class,'collection_id');
    }
    
}
