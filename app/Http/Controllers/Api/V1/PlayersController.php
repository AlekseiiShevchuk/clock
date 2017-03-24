<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePlayersRequest;
use App\Player;
use App\PlayerMovieCollection;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    public function show()
    {
        $this->addLanguageCollectionIfDoesNotExist(Auth::user());
        return Auth::user()->load('collections.movies.publish_request');
    }

    public function update(UpdatePlayersRequest $request)
    {
        Auth::user()->nickname = ($request->get('nickname'));
        Auth::user()->device_token = ($request->get('device_token'));
        Auth::user()->save();
        return Auth::user();
    }

    private function addLanguageCollectionIfDoesNotExist(Player $player)
    {
        $languageNames = \App\Language::where('is_active_for_users', 1)->get()->pluck('name', 'id')->toArray();
        foreach ($languageNames as $language_id => $languageName) {
            $playerMovieCollection = PlayerMovieCollection::where([
                'name' => $languageName,
                'player_id' => $player->id,
                'language_id' => $language_id,
            ])->first();
            if ($playerMovieCollection instanceof PlayerMovieCollection) {
                continue;
            } else {
                PlayerMovieCollection::create([
                    'name' => $languageName,
                    'player_id' => $player->id,
                    'language_id' => $language_id,
                ]);
            }
        }
    }
}
