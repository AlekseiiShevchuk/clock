<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name', 'description', 'path', 'answer', 'level_id'];
    protected $guarded = ['id', '_token'];
    protected $hidden = ['updated_at','created_at'];

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
