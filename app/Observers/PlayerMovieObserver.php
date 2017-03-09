<?php

namespace App\Observers;

use App\Jobs\OptimizeVideoFile;
use App\PlayerMovie;
use Illuminate\Support\Facades\Queue;

class PlayerMovieObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the PlayerMovie created event.
     *
     * @param  PlayerMovie $playerMovie
     * @return void
     */
    public function created(PlayerMovie $playerMovie)
    {
        dispatch(new OptimizeVideoFile($playerMovie));
    }

    public function creating(PlayerMovie $playerMovie)
    {
    }

    /**
     * Listen to the PlayerMovie deleting event.
     *
     * @param  PlayerMovie $playerMovie
     * @return void
     */
    public function deleting(PlayerMovie $playerMovie)
    {
    }
}