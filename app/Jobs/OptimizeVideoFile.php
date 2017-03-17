<?php

namespace App\Jobs;

use App\HasMovieFileContract;
use App\Movie;
use App\PlayerMovie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OptimizeVideoFile implements ShouldQueue
{
    protected $objectWithMovie;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct(HasMovieFileContract $objectWithMovie)
    {
        $this->objectWithMovie = $objectWithMovie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $movies = Movie::where('movie_file', $this->objectWithMovie->getMovieFileName())->get();
        $playerMovies = PlayerMovie::where('movie_file', $this->objectWithMovie->getMovieFileName())->get();

        $convertedVideoName = $this->objectWithMovie->getQualifiedKeyName() . '_' . $this->objectWithMovie->getId() . '.mp4';

        $in = public_path('uploads/' . $this->objectWithMovie->getMovieFileName());
        $out = public_path('uploads/' . $convertedVideoName);

        $outputAfterCommandRun = `ffmpeg -y -i {$in} -acodec libmp3lame -ar 44100 -ac 1 -vcodec libx264 -vf scale=640:-1 -fs 50M {$out}`;

        if (filesize($out) > 100 && (filesize($out) < filesize($in))) {
            $this->objectWithMovie->setMovieFileName($convertedVideoName);

            foreach ($movies as $movie) {
                $movie->setMovieFileName($convertedVideoName);
            }

            foreach ($playerMovies as $movie) {
                $movie->setMovieFileName($convertedVideoName);
            }

            unlink($in);
        } else {
            unlink($out);
        }

    }
}
