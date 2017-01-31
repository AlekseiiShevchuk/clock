<?php

namespace App\Http\Controllers;

use App\Level;
use Response;
use Illuminate\Http\Request;

class LevelsApiController extends Controller
{
    public function getAllLevels(Request $request)
    {
        $levels = Level::all();
        return Response::json(array(
            'error' => false,
            'modes' => $levels,
            'status_code' => 200
        ));
    }

    public function showLevelsId($id)
    {
        return Level::findOrFail($id);
    }
}
