<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    protected $guarded = ['id', '_token'];

    public function setDescriptionAttribute($input)
    {
        $this->attributes['description'] = $input ? $input : null;
    }
    public function movies()
    {
        return $this->belongsTo('App\Movie', 'id', 'level_id');
    }
}