<?php

namespace App\Http\Controllers;

use App\PlayerMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePlayerMoviesRequest;
use App\Http\Requests\UpdatePlayerMoviesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class PlayerMoviesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of PlayerMovie.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('playerMovie_access')) {
            return abort(401);
        }
        $playerMovies = PlayerMovie::all();

        return view('playermovies.index', compact('playerMovies'));
    }

    /**
     * Show the form for creating new PlayerMovie.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('playerMovie_create')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
            'collections' => \App\PlayerMovieCollection::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $enum_moderated = PlayerMovie::$enum_moderated;
            
        return view('playermovies.create', compact('enum_moderated') + $relations);
    }

    /**
     * Store a newly created PlayerMovie in storage.
     *
     * @param  \App\Http\Requests\StorePlayerMoviesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerMoviesRequest $request)
    {
        if (! Gate::allows('playerMovie_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $playerMovie = PlayerMovie::create($request->all());

        return redirect()->route('playermovies.index');
    }


    /**
     * Show the form for editing PlayerMovie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('playerMovie_edit')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
            'collections' => \App\PlayerMovieCollection::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];
        $enum_moderated = PlayerMovie::$enum_moderated;
            
        $playerMovie = PlayerMovie::findOrFail($id);

        return view('playermovies.edit', compact('playerMovie', 'enum_moderated') + $relations);
    }

    /**
     * Update PlayerMovie in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayerMoviesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayerMoviesRequest $request, $id)
    {
        if (! Gate::allows('playerMovie_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $playerMovie = PlayerMovie::findOrFail($id);
        $playerMovie->update($request->all());

        return redirect()->route('playermovies.index');
    }


    /**
     * Display PlayerMovie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('playerMovie_view')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
            'collections' => \App\PlayerMovieCollection::get()->pluck('name', 'id')->prepend('Please select', ''),
            'abuses' => \App\Abuse::where('player_movie_id', $id)->get(),
        ];

        $playerMovie = PlayerMovie::findOrFail($id);

        return view('playermovies.show', compact('playerMovie') + $relations);
    }


    /**
     * Remove PlayerMovie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('playerMovie_delete')) {
            return abort(401);
        }
        $playerMovie = PlayerMovie::findOrFail($id);
        $playerMovie->delete();

        return redirect()->route('playermovies.index');
    }

    /**
     * Delete all selected PlayerMovie at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('playerMovie_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PlayerMovie::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
