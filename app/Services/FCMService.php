<?php

namespace App\Services;

use App\PlayerMovieCollection;
use App\Player;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FCMService
{
    /**
     * Send Notification To PlayerMovieCollection Owner after Player join the playerMovieCollection.
     *
     * @param  PlayerMovieCollection $playerMovieCollection
     * @param  Player $joinedPlayer
     */
    public function send_Notification_To_PlayerMovieCollection_Owner_After_Player_Join(PlayerMovieCollection $playerMovieCollection, Player $joinedPlayer)
    {
        $token = $playerMovieCollection->player->device_token;
        if ($token == null){
            return;
        }
        $title = 'New player join ' . $playerMovieCollection->name;
        $body = 'Player ' . $joinedPlayer->nickname . ' join challenge ' . $playerMovieCollection->name;

        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['type' => 'player_joined']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }

    /**
     * Send Notification to all playerMovieCollection players about playerMovieCollection was started by owner.
     *
     * @param  PlayerMovieCollection $playerMovieCollection
     * @param  Player $joinedPlayer
     */
    public function send_Notification_To_All_Players_After_Player_Join(PlayerMovieCollection $playerMovieCollection, Player $joinedPlayer)
    {
        $tokens = [];
        foreach ($playerMovieCollection->players as $player) {
            if ($player->device_token == null || $player->device_token == '') {
                continue;
            }
            $tokens[] = $player->device_token;
        }

        if ($playerMovieCollection->player->device_token !== null &&
            $playerMovieCollection->player->device_token != '' &&
            !array_search($playerMovieCollection->player->device_token, $tokens)
        ) {
            $tokens[] = $playerMovieCollection->player->device_token;
        }

        if(count($tokens) < 1){
            return;
        }
        $title = 'New player join ' . $playerMovieCollection->name;
        $body = 'Player ' . $joinedPlayer->nickname . ' join challenge ' . $playerMovieCollection->name;

        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['type' => 'player_joined']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }

    /**
     * Send Notification to all playerMovieCollection players about playerMovieCollection was started by owner.
     *
     * @param  PlayerMovieCollection $playerMovieCollection
     */
    public function send_Notification_To_Players_About_PlayerMovieCollection_Started(PlayerMovieCollection $playerMovieCollection)
    {
        $tokens = [];
        foreach ($playerMovieCollection->players as $player) {
            if ($player->device_token == null || $player->device_token == '' || $player->id == $playerMovieCollection->player->id) {
                continue;
            }
            $tokens[] = $player->device_token;
        }
        if(count($tokens) < 1){
            return;
        }
        $title = 'Challenge ' . $playerMovieCollection->name . ' started!';
        $body = 'Challenge ' . $playerMovieCollection->name . ' started!';

        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['type' => 'challenge_started']);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }

}