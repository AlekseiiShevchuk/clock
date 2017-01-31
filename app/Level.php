<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'description'];
    protected $guarded = ['id', '_token'];
    protected $hidden = ['updated_at','created_at'];

    public function setDescriptionAttribute($input)
    {
        $this->attributes['description'] = $input ? $input : null;
    }
    public function movies()
    {
        return $this->belongsTo('App\Movie', 'id', 'level_id');
    }
}