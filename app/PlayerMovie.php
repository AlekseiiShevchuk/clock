<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PlayerMovie
 *
 * @package App
 * @property string $player
 * @property string $language
 * @property string $collection
 * @property string $name
 * @property string $description
 * @property string $answer
 * @property string $movie_file
 * @property enum $moderated
 */
class PlayerMovie extends Model implements HasMovieFileContract
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->moderated = self::$enum_moderated["onModeration"];
    }

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'answer',
        'movie_file',
        'moderated',
        'player_id',
        'language_id',
        'collection_id'
    ];


    public static $enum_moderated = [
        "onModeration" => "OnModeration",
        "Accepted" => "Accepted",
        "Declined" => "Declined"
    ];

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

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCollectionIdAttribute($input)
    {
        $this->attributes['collection_id'] = $input ? $input : null;
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withTrashed();
    }

    public function collection()
    {
        return $this->belongsTo(PlayerMovieCollection::class, 'collection_id')->withTrashed();
    }

}
