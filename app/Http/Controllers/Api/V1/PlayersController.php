<?php

namespace App\Http\Controllers\Api\V1;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayersRequest;
use App\Http\Requests\UpdatePlayersRequest;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    public function show()
    {
        return Auth::user()->load('collections.movies');
    }

    public function update(UpdatePlayersRequest $request)
    {
        Auth::user()->nickname = ($request->get('nickname'));
        Auth::user()->save();
        return Auth::user();
    }
}
