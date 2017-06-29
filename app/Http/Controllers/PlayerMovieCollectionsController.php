<?php

namespace App\Http\Controllers;

use App\PlayerMovieCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePlayerMovieCollectionsRequest;
use App\Http\Requests\UpdatePlayerMovieCollectionsRequest;

class PlayerMovieCollectionsController extends Controller
{
    /**
     * Display a listing of PlayerMovieCollection.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('playerMovieCollection_access')) {
            return abort(401);
        }
        $playerMovieCollections = PlayerMovieCollection::all();

        return view('playermoviecollections.index', compact('playerMovieCollections'));
    }

    /**
     * Show the form for creating new PlayerMovieCollection.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('playerMovieCollection_create')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('playermoviecollections.create', $relations);
    }

    /**
     * Store a newly created PlayerMovieCollection in storage.
     *
     * @param  \App\Http\Requests\StorePlayerMovieCollectionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerMovieCollectionsRequest $request)
    {
        if (! Gate::allows('playerMovieCollection_create')) {
            return abort(401);
        }
        $playerMovieCollection = PlayerMovieCollection::create($request->all());

        return redirect()->route('playermoviecollections.index');
    }


    /**
     * Show the form for editing PlayerMovieCollection.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('playerMovieCollection_edit')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);

        return view('playermoviecollections.edit', compact('playerMovieCollection') + $relations);
    }

    /**
     * Update PlayerMovieCollection in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayerMovieCollectionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayerMovieCollectionsRequest $request, $id)
    {
        if (! Gate::allows('playerMovieCollection_edit')) {
            return abort(401);
        }
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        $playerMovieCollection->update($request->all());

        return redirect()->route('playermoviecollections.index');
    }


    /**
     * Display PlayerMovieCollection.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('playerMovieCollection_view')) {
            return abort(401);
        }
        $relations = [
            'players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
            'playerMovies' => \App\PlayerMovie::where('collection_id', $id)->get(),
        ];

        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);

        return view('playermoviecollections.show', compact('playerMovieCollection') + $relations);
    }


    /**
     * Remove PlayerMovieCollection from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('playerMovieCollection_delete')) {
            return abort(401);
        }
        $playerMovieCollection = PlayerMovieCollection::findOrFail($id);
        $playerMovieCollection->delete();

        return redirect()->route('playermoviecollections.index');
    }

    /**
     * Delete all selected PlayerMovieCollection at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('playerMovieCollection_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PlayerMovieCollection::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
