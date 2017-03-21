<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\ApiStorePlayerMoviesRequest;
use App\Http\Requests\ApiUpdatePlayerMoviesRequest;
use App\PlayerMovie;
use App\PlayerMovieCollection;
use App\PublishRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerMoviesController extends Controller
{
    use FileUploadTrait;

    /*    public function index()
        {
            return PlayerMovie::all();
        }

        public function show($id)
        {
            return PlayerMovie::findOrFail($id);
        }
    */
    public function update(ApiUpdatePlayerMoviesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $playerMovie = PlayerMovie::findOrFail($id);
        $playerMovie->update($request->all());

        return $playerMovie;
    }

    public function store(ApiStorePlayerMoviesRequest $request)
    {
        $request = $this->saveFiles($request);
        $playerMovie = PlayerMovie::create($request->all());
        $playerMovie->moderated = PlayerMovie::$enum_moderated['onModeration'];
        $playerMovie->player_id = Auth::user()->id;
        $playerMovie->save();

        return $playerMovie->fresh();
    }

    public function destroy(ApiUpdatePlayerMoviesRequest $request, $id)
    {
        $playerMovie = PlayerMovie::findOrFail($id);
        $playerMovie->delete();
        return response('', 204);
    }

    public function copyMoviesToOtherCollection(Request $request, PlayerMovieCollection $collection)
    {
        if ($collection->status == PlayerMovieCollection::STATUS_STARTED) {
            return response()->json('The challenge is already started by owner, now you can not add any players or movies',
                400);
        }
        $arrayOfMovieIds = $request->get('array_of_player_movie_ids');
        $newMovies = new Collection();
        foreach ($arrayOfMovieIds as $id) {
            $movie = PlayerMovie::findOrFail($id);
            $oldMovie = $movie->toArray();
            $oldMovie['collection_id'] = $collection->id;
            $newMovie = PlayerMovie::create($oldMovie);
            $newMovies->add($newMovie);
        }
        $collection->touch();
        return $newMovies;
    }

    public function makePublishRequest(PlayerMovie $playerMovie)
    {
        $publish_request = PublishRequest::where('player_movie_id', $playerMovie->id)->first();

        if ($publish_request instanceof PublishRequest && $publish_request->is_published == 0) {
            return response()->json('this movie already waiting for publishing', '400');
        }
        if ($publish_request instanceof PublishRequest && $publish_request->is_published == 1) {
            return response()->json('this movie is already published', '400');
        }

        $publish_request = PublishRequest::create([
            'player_movie_id' => $playerMovie->id
        ]);
        return response()->json('Publish request successfully created', 201);
    }
}
