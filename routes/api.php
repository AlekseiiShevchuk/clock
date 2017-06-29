<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::get('languages', 'LanguagesController@index');
        Route::get('translations', 'LanguagesController@translationItemsList');

        Route::resource('levels', 'LevelsController');

        Route::get('profile', 'PlayersController@show');
        Route::put('profile', 'PlayersController@update');

        Route::resource('player-movie-collections', 'PlayerMovieCollectionsController');
        Route::get('player-movie-collections/{playerMovieCollection}/join-challenge', 'PlayerMovieCollectionsController@addPlayerToCollection');
        Route::get('player-movie-collections/{playerMovieCollection}/start-group-challenge', 'PlayerMovieCollectionsController@startGroupChallenge');

        Route::resource('player-movies', 'PlayerMoviesController');
        Route::post('player-movies/copy-to-other-collection/{collection}', 'PlayerMoviesController@copyMoviesToOtherCollection');
        Route::post('player-movies/{player_movie_id}/abuse', 'AbusesController@store');
        Route::get('player-movies/{playerMovie}/make-publish-request', 'PlayerMoviesController@makePublishRequest');

        Route::resource('abuses', 'AbusesController');

});
