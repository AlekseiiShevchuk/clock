<?php

namespace App\Observers;

use App\Jobs\OptimizeVideoFile;
use App\PlayerMovie;
use App\Services\VideoThumbnailMaker;
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
        VideoThumbnailMaker::makeThumbnail($playerMovie);
    }

    public function creating(PlayerMovie $playerMovie)
    {
        PlayerMovie::unguard();
        $playerMovie->original_movie_file = $playerMovie->movie_file;
        PlayerMovie::reguard();
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