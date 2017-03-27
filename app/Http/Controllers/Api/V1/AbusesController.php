<?php

namespace App\Http\Controllers\Api\V1;

use App\Abuse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbusesRequest;
use Illuminate\Support\Facades\Auth;

class AbusesController extends Controller
{

    public function store($player_movie_id, StoreAbusesRequest $request)
    {
        $abuse = Abuse::create($request->only(['description', 'email']));
        $abuse->player_movie_id = $player_movie_id;
        $abuse->by_player_id = Auth::id();
        $abuse->save();

        return $abuse;
    }
}
