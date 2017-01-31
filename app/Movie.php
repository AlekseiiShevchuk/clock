<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
//    protected $fillable = ['name', 'description', 'path', 'answer', 'level_id'];
    protected $guarded = ['id', '_token'];

    public function setNameAttribute($input)
    {
        $this->attributes['name'] = $input ? $input : null;
    }

    public function setDescriptionAttribute($input)
    {
        $this->attributes['description'] = $input ? $input : null;
    }

    public function levels()
    {
        return $this->hasOne('App\Level', 'id');
    }
}
