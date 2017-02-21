<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    protected $fillable = ['device_id', 'nickname'];

    public function collections()
    {
        return $this->hasMany(PlayerMovieCollection::class);
    }
}
