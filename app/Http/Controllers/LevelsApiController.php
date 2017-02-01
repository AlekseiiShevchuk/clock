<?php

namespace App\Http\Controllers;

use App\Level;
use Response;
use Illuminate\Http\Request;

class LevelsApiController extends Controller
{
    public function getAllLevels()
    {
//        $levels = Level::all();
//        return Response::json(array(
//            'error' => false,
//            'modes' => $levels,
//            'status_code' => 200
//        ));
        return Level::all();
    }

    public function showLevelsId($id)
    {
        return Level::findOrFail($id);
    }

    public function showLevelMovies($id)
    {
        $movies = Level::with('movies')->find($id);
        return $movies;
    }


}
