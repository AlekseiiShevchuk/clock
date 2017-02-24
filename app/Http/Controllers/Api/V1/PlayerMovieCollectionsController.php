<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\ApiStorePlayerMovieCollectionsRequest;
use App\PlayerMovieCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlayerMovieCollectionsController extends Controller
{
    public function index()
    {
        return PlayerMovieCollection::all();
    }

    public function show($id)
    {
        return PlayerMovieCollection::findOrFail($id)->load('movies');
    }

    public function update(ApiStorePlayerMovieCollectionsRequest $request, $id)
    {
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        $playerMovieCollection->update($request->only(['name', 'description', 'language_id']));
        $playerMovieCollection->player_id = Auth::user()->id;
        $playerMovieCollection->save();

        return $playerMovieCollection->load('movies');
    }

    public function store(ApiStorePlayerMovieCollectionsRequest $request)
    {
        $playerMovieCollection = PlayerMovieCollection::create($request->only(['name', 'description', 'language_id']));
        $playerMovieCollection->player_id = Auth::user()->id;
        $playerMovieCollection->save();

        return $playerMovieCollection;
    }

    public function destroy($id)
    {
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        foreach ($playerMovieCollection->movies as $movie){
            $movie->delete();
        }
        $playerMovieCollection->delete();
        return response('', 204);
    }
}
