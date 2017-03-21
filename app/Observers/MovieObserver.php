<?php

namespace App\Observers;

use App\Jobs\OptimizeVideoFile;
use App\Movie;
use Illuminate\Support\Facades\Queue;

class MovieObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the Movie created event.
     *
     * @param  Movie $movie
     * @return void
     */
    public function created(Movie $movie)
    {
    }

    public function creating(Movie $movie)
    {
        Movie::unguard();
        $movie->original_movie_file = $movie->movie_file;
        Movie::reguard();
    }

    /**
     * Listen to the Movie deleting event.
     *
     * @param  Movie $movie
     * @return void
     */
    public function deleting(Movie $movie)
    {
    }
}