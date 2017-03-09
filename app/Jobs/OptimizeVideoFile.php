<?php

namespace App\Jobs;

use App\HasMovieFileContract;
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
        $convertedVideoName = $this->objectWithMovie->getQualifiedKeyName() . '_' . $this->objectWithMovie->getId() .  '.mp4';

        $in = public_path('uploads/' . $this->objectWithMovie->getMovieFileName());
        $out = public_path('uploads/' . $convertedVideoName);

        $outputAfterCommandRun = `ffmpeg -y -i {$in} -acodec libmp3lame -ar 44100 -ac 1 -vcodec libx264 -s 640x360 {$out}`;
        echo $outputAfterCommandRun;
        $this->objectWithMovie->setMovieFileName($convertedVideoName);

        unlink($in);
    }
}