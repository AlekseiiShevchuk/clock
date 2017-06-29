<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreLevelsRequest;
use App\Http\Requests\UpdateLevelsRequest;

class LevelsController extends Controller
{
    /**
     * Display a listing of Level.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('level_access')) {
            return abort(401);
        }
        $levels = Level::all();

        return view('levels.index', compact('levels'));
    }

    /**
     * Show the form for creating new Level.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('level_create')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('levels.create', $relations);
    }

    /**
     * Store a newly created Level in storage.
     *
     * @param  \App\Http\Requests\StoreLevelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLevelsRequest $request)
    {
        if (! Gate::allows('level_create')) {
            return abort(401);
        }
        $level = Level::create($request->all());

        return redirect()->route('levels.index');
    }


    /**
     * Show the form for editing Level.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('level_edit')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $level = Level::findOrFail($id);

        return view('levels.edit', compact('level') + $relations);
    }

    /**
     * Update Level in storage.
     *
     * @param  \App\Http\Requests\UpdateLevelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevelsRequest $request, $id)
    {
        if (! Gate::allows('level_edit')) {
            return abort(401);
        }
        $level = Level::findOrFail($id);
        $level->update($request->all());

        return redirect()->route('levels.index');
    }


    /**
     * Display Level.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('level_view')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::where('is_active_for_users',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
            'movies' => \App\Movie::where('level_id', $id)->get(),
        ];

        $level = Level::findOrFail($id);

        return view('levels.show', compact('level') + $relations);
    }


    /**
     * Remove Level from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('level_delete')) {
            return abort(401);
        }
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('levels.index');
    }

    /**
     * Delete all selected Level at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('level_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Level::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
