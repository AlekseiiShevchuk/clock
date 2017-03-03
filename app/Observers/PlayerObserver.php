<?php

namespace App\Observers;

use App\Player;
use App\PlayerMovieCollection;

class PlayerObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the Player created event.
     *
     * @param  Player $player
     * @return void
     */
    public function created(Player $player)
    {
        $languageNames = \App\Language::where('is_active_for_users', 1)->get()->pluck('name', 'id')->toArray();
        foreach ($languageNames as $language_id => $languageName){
            PlayerMovieCollection::create([
                'name' => $languageName,
                'player_id' => $player->id,
                'language_id' => $language_id,
            ]);
        }
    }

    public function creating(Player $player)
    {
    }

    /**
     * Listen to the Player deleting event.
     *
     * @param  Player $player
     * @return void
     */
    public function deleting(Player $player)
    {
    }
}