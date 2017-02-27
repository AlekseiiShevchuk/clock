<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('languages', 'LanguagesController');

        Route::resource('levels', 'LevelsController');

        Route::get('profile', 'PlayersController@show');
        Route::put('profile', 'PlayersController@update');

        Route::resource('player-movie-collections', 'PlayerMovieCollectionsController');
        Route::resource('player-movies', 'PlayerMoviesController');
        Route::get('player-movies/{movie}/copy-to-other-collection/{collection}', 'PlayerMoviesController@copyMovieToOtherCollection');

        Route::resource('abuses', 'AbusesController');

});
