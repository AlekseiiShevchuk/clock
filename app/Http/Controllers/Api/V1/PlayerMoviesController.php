<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\ApiStorePlayerMoviesRequest;
use App\Http\Requests\ApiUpdatePlayerMoviesRequest;
use App\PlayerMovie;
use App\PlayerMovieCollection;
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
        $playerMovie->update($request->only([
            'name',
            'description',
            'answer',
            'language_id',
            'collection_id'
        ]));

        return $playerMovie;
    }

    public function store(ApiStorePlayerMoviesRequest $request)
    {
        $request = $this->saveFiles($request);
        $playerMovie = PlayerMovie::create($request->only([
            'name',
            'description',
            'answer',
            'movie_file',
            'language_id',
            'collection_id'
        ]));
        $playerMovie->moderated = PlayerMovie::$enum_moderated['onModeration'];
        $playerMovie->player_id = Auth::user()->id;
        $playerMovie->save();

        return $playerMovie;
    }

    public function destroy(ApiUpdatePlayerMoviesRequest $request, $id)
    {
        $playerMovie = PlayerMovie::findOrFail($id);
        $playerMovie->delete();
        return response('', 204);
    }

    public function copyMoviesToOtherCollection(Request $request, PlayerMovieCollection $collection)
    {
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
}
