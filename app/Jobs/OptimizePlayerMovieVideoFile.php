<?php

namespace App\Jobs;

use App\PlayerMovie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OptimizePlayerMovieVideoFile implements ShouldQueue
{
    protected $playerMovie;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct(PlayerMovie $playerMovie)
    {
        $this->playerMovie = $playerMovie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $convertedVideoName = $this->playerMovie->id . '.mp4';

        $in = public_path('uploads/' . $this->playerMovie->movie_file);
        $out = public_path('uploads/' . $convertedVideoName);

        $outputAfterCommandRun = `ffmpeg -y -i {$in} -acodec libmp3lame -ar 44100 -ac 1 -vcodec libx264 -s 640x360 {$out}`;
        echo $outputAfterCommandRun;
        $this->playerMovie->movie_file = $convertedVideoName;
        $this->playerMovie->save();
        unlink($in);
    }
}
