<?php

namespace App\Http\Controllers;

use App\Abuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreAbusesRequest;
use App\Http\Requests\UpdateAbusesRequest;

class AbusesController extends Controller
{
    /**
     * Display a listing of Abuse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('abus_access')) {
            return abort(401);
        }
        $abuses = Abuse::all();

        return view('abuses.index', compact('abuses'));
    }

    /**
     * Show the form for creating new Abuse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('abus_create')) {
            return abort(401);
        }
        $relations = [
            'player_movies' => \App\PlayerMovie::get()->pluck('name', 'id')->prepend('Please select', ''),
            'by_players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
        ];

        return view('abuses.create', $relations);
    }

    /**
     * Store a newly created Abuse in storage.
     *
     * @param  \App\Http\Requests\StoreAbusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbusesRequest $request)
    {
        if (! Gate::allows('abus_create')) {
            return abort(401);
        }
        $abuse = Abuse::create($request->all());

        return redirect()->route('abuses.index');
    }


    /**
     * Show the form for editing Abuse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('abus_edit')) {
            return abort(401);
        }
        $relations = [
            'player_movies' => \App\PlayerMovie::get()->pluck('name', 'id')->prepend('Please select', ''),
            'by_players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
        ];

        $abuse = Abuse::findOrFail($id);

        return view('abuses.edit', compact('abuse') + $relations);
    }

    /**
     * Update Abuse in storage.
     *
     * @param  \App\Http\Requests\UpdateAbusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbusesRequest $request, $id)
    {
        if (! Gate::allows('abus_edit')) {
            return abort(401);
        }
        $abuse = Abuse::findOrFail($id);
        $abuse->update($request->all());

        return redirect()->route('abuses.index');
    }


    /**
     * Display Abuse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('abus_view')) {
            return abort(401);
        }
        $relations = [
            'player_movies' => \App\PlayerMovie::get()->pluck('name', 'id')->prepend('Please select', ''),
            'by_players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
        ];

        $abuse = Abuse::findOrFail($id);

        return view('abuses.show', compact('abuse') + $relations);
    }


    /**
     * Remove Abuse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('abus_delete')) {
            return abort(401);
        }
        $abuse = Abuse::findOrFail($id);
        $abuse->delete();

        return redirect()->route('abuses.index');
    }

    /**
     * Delete all selected Abuse at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('abus_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Abuse::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
