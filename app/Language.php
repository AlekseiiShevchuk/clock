<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 *
 * @package App
 * @property string $abbreviation
 * @property string $name
 * @property tinyInteger $is_active_for_admin
 * @property tinyInteger $is_active_for_users
 */
class Language extends Model
{
    use SoftDeletes;

    protected $fillable = ['abbreviation', 'name', 'is_active_for_admin', 'is_active_for_users', 'flag_image'];
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];
    protected $appends = ['number_of_movies'];

    public function getNumberOfMoviesAttribute()
    {
        return Movie::where('language_id', $this->id)->count();
    }

    static function getAvailableColumnsForTranslationItems()
    {
        $columns[] = 'value_name';
        foreach (Language::where('is_active_for_users', 1)->pluck('abbreviation') as $abbr) {
            $columns[] = 'value_' . $abbr;
        }

        return $columns;
    }
}
