<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiStorePlayerMovieCollectionsRequest;
use App\PlayerMovie;
use App\PlayerMovieCollection;
use App\PublishRequest;
use Illuminate\Support\Facades\Auth;

class PlayerMovieCollectionsController extends Controller
{
    public function index()
    {
        return PlayerMovieCollection::all();
    }

    public function show($id)
    {
        return PlayerMovieCollection::findOrFail($id)->load(['movies.publish_request', 'players']);
    }

    public function update(ApiStorePlayerMovieCollectionsRequest $request, $id)
    {
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        $playerMovieCollection->update($request->only(['name', 'description', 'language_id']));
        $playerMovieCollection->player_id = Auth::user()->id;
        $playerMovieCollection->save();
        PublishRequest::setHidden(['id']);
        return $playerMovieCollection->load(['movies.publish_request', 'players']);
    }

    public function store(ApiStorePlayerMovieCollectionsRequest $request)
    {
        $playerMovieCollection = PlayerMovieCollection::create($request->only([
            'name',
            'description',
            'language_id',
            'type'
        ]));
        $playerMovieCollection->player_id = Auth::user()->id;
        if ($request->get('type') == PlayerMovieCollection::GROUP_CHALLENGE) {
            $playerMovieCollection->status = PlayerMovieCollection::STATUS_COMPOSING;
        }
        $playerMovieCollection->save();

        return $playerMovieCollection;
    }

    public function destroy($id)
    {
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        foreach ($playerMovieCollection->movies as $movie) {
            $movie->delete();
        }
        $playerMovieCollection->delete();
        return response('', 204);
    }

    public function addPlayerToCollection(PlayerMovieCollection $playerMovieCollection)
    {
        if ($playerMovieCollection->status == PlayerMovieCollection::STATUS_STARTED) {
            return response()->json('The challenge is already started by owner, now you can not add any players or movies',
                400);
        }
        $playerMovieCollection->players()->syncWithoutDetaching([Auth::user()->id]);
        $playerMovieCollection->touch();
        $playerMovieCollection->save();
        return $playerMovieCollection->fresh(['movies.publish_request', 'players']);
    }

    public function startGroupChallenge(PlayerMovieCollection $playerMovieCollection)
    {
        if (Auth::user()->id != $playerMovieCollection->player_id) {
            return response()->json('Only challenge owner can start the challenge', 400);
        }
        $playerMovieCollection->status = PlayerMovieCollection::STATUS_STARTED;

        $tenRandomMovies = PlayerMovie::where('collection_id', $playerMovieCollection->id)
            ->get()->shuffle()->take(10)
            ->pluck('id')->toArray();

        $moviesToDelete = PlayerMovie::where('collection_id', $playerMovieCollection->id)
            ->whereNotIn('id', $tenRandomMovies)->get();

        foreach ($moviesToDelete as $movieToDelete) {
            $movieToDelete->delete();
        }

        $playerMovieCollection->save();

        return $playerMovieCollection->fresh(['movies.publish_request', 'players']);
    }
}
