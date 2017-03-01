<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublishRequestsRequest;
use App\Http\Requests\UpdatePublishRequestsRequest;
use App\Level;
use App\Movie;
use App\PublishRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PublishRequestsController extends Controller
{
    /**
     * Display a listing of PublishRequest.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('publish_request_access')) {
            return abort(401);
        }
        $publish_requests = PublishRequest::all();

        return view('publish_requests.index', compact('publish_requests'));
    }

    /**
     * Show the form for creating new PublishRequest.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('publish_request_create')) {
            return abort(401);
        }
        $relations = [
            'player_movies' => \App\PlayerMovie::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('publish_requests.create', $relations);
    }

    /**
     * Store a newly created PublishRequest in storage.
     *
     * @param  \App\Http\Requests\StorePublishRequestsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublishRequestsRequest $request)
    {
        if (!Gate::allows('publish_request_create')) {
            return abort(401);
        }
        $publish_request = PublishRequest::create($request->all());

        return redirect()->route('publish_requests.index');
    }


    /**
     * Show the form for editing PublishRequest.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('publish_request_edit')) {
            return abort(401);
        }
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        //add language for levels list
        foreach ($relations['levels'] as $levelId => $levelName) {
            if ($levelId < 1){continue;}
            $levelLanguage = Level::find($levelId)->language->name;
            $relations['levels'][$levelId] .= ' | ' . $levelLanguage;
        }

        $publish_request = PublishRequest::findOrFail($id);

        return view('publish_requests.edit', compact('publish_request') + $relations);
    }

    /**
     * Update PublishRequest in storage.
     *
     * @param  \App\Http\Requests\UpdatePublishRequestsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublishRequestsRequest $request, $id)
    {

        $publish_request = PublishRequest::findOrFail($id);
        $player_movie = $publish_request->player_movie;
        $level = Level::findOrFail($request->get('level_id'));
        $movie = Movie::create([
            'name' => $player_movie->name,
            'description' => $player_movie->description,
            'answer' => $player_movie->answer,
            'movie_file' => $player_movie->movie_file,
            'language_id' => $player_movie->language_id,
            'level_id' => $level->id,
        ]);
        $publish_request->published_to()->associate($movie);
        $publish_request->is_published = 1;
        $publish_request->save();
        return redirect()->route('publish_requests.index');
    }


    /**
     * Display PublishRequest.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('publish_request_view')) {
            return abort(401);
        }
        $relations = [
            'player_movies' => \App\PlayerMovie::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $publish_request = PublishRequest::findOrFail($id);

        return view('publish_requests.show', compact('publish_request') + $relations);
    }


    /**
     * Remove PublishRequest from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('publish_request_delete')) {
            return abort(401);
        }
        $publish_request = PublishRequest::findOrFail($id);
        $publish_request->delete();

        return redirect()->route('publish_requests.index');
    }

    /**
     * Delete all selected PublishRequest at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('publish_request_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PublishRequest::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
