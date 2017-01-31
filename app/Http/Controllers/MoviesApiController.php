<?php

namespace App\Http\Controllers;

use App\Movie;
use Response;
use Illuminate\Http\Request;

class MoviesApiController extends Controller
{
    public function getAllMovies(Request $request)
    {
        $movies = Movie::all();
        return Response::json(array(
            'error' => false,
            'modes' => $movies,
            'status_code' => 200
        ));
    }

    public function showMoviesId($id)
    {
        return Movie::findOrFail($id);
    }

    public function showMoviesLevelID($id)
    {
        return Movie::where('level_id', $id)->get();

    }
}
