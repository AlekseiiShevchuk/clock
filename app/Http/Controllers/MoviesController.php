<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\StoreMoviesRequest;
use App\Http\Requests\UpdateMoviesRequest;
use App\Jobs\OptimizeVideoFile;
use App\Level;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MoviesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Movie.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('movie_access')) {
            return abort(401);
        }
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating new Movie.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('movie_create')) {
            return abort(401);
        }
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin', 1)->get()->pluck('name', 'id')
                ->prepend('Please select', ''),
        ];
        //add language for levels list
        foreach ($relations['levels'] as $levelId => $levelName) {
            if ($levelId < 1){continue;}
            $levelLanguage = Level::find($levelId)->language->name;
            $relations['levels'][$levelId] .= ' | ' . $levelLanguage;
        }
        return view('movies.create', $relations);
    }

    /**
     * Store a newly created Movie in storage.
     *
     * @param  \App\Http\Requests\StoreMoviesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMoviesRequest $request)
    {
        if (!Gate::allows('movie_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $movie = Movie::create($request->all());
        dispatch(new OptimizeVideoFile($movie));
        return redirect()->route('movies.index');
    }


    /**
     * Show the form for editing Movie.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('movie_edit')) {
            return abort(401);
        }
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin', 1)->get()->pluck('name',
                'id')->prepend('Please select', ''),
        ];

        $movie = Movie::findOrFail($id);

        return view('movies.edit', compact('movie') + $relations);
    }

    /**
     * Update Movie in storage.
     *
     * @param  \App\Http\Requests\UpdateMoviesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMoviesRequest $request, $id)
    {
        if (!Gate::allows('movie_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return redirect()->route('movies.index');
    }


    /**
     * Display Movie.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('movie_view')) {
            return abort(401);
        }
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin', 1)->get()->pluck('name',
                'id')->prepend('Please select', ''),
        ];

        $movie = Movie::findOrFail($id);

        return view('movies.show', compact('movie') + $relations);
    }


    /**
     * Remove Movie from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('movie_delete')) {
            return abort(401);
        }
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index');
    }

    /**
     * Delete all selected Movie at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('movie_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Movie::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
