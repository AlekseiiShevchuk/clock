<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 20.04.2017
 * Time: 11:16
 */

namespace App\Services;


use App\HasMovieFileContract;

class VideoThumbnailMaker
{

    static public function makeThumbnail(HasMovieFileContract $objectWithMovie)
    {
// Code to generate video thumbnail

// Location where video thumbnail to store
        $thumbnail_path = 'your_site_domain/media/images/thumbnail/';
        $second = 1;
        $thumbSize = '200x200';

// Video file name without extension(.mp4 etc)
        $videoname = $objectWithMovie->getMovieFileName();
        $video_file_path = public_path('uploads/' . $objectWithMovie->getMovieFileName());
        $path_to_store_generated_thumbnail = public_path('uploads/' . $videoname . '.jpg');

// FFmpeg Command to generate video thumbnail

        $cmd = `ffmpeg -i "{$video_file_path}" -deinterlace -an -ss {$second} -t 00:00:01  -s {$thumbSize} -r 1 -y -vcodec mjpeg -f mjpeg "{$path_to_store_generated_thumbnail}" 2>&1`;
        $objectWithMovie->thumbnail = $videoname . '.jpg';
        $objectWithMovie->save();

        //exec($cmd, $output, $retval);

//        if ($retval) {
//            echo 'error in generating video thumbnail';
//        } else {
//            echo 'Thumbnail generated successfully';
//            $objectWithMovie->thumbnail = $thumbnail_path . $videoname . '.jpg';
//            $objectWithMovie->save();
//        }
    }
}