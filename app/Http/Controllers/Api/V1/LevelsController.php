<?php

namespace App\Http\Controllers\Api\V1;

use App\Language;
use App\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelsController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('language_id')){
            Language::findOrFail($request->get('language_id'));
            return Level::where('language_id',$request->get('language_id'))->with(['movies.language','language'])->get();
        }
        return Level::all()->load(['movies.language','language']);
    }
}
