<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('languages', 'LanguagesController');

        Route::resource('levels', 'LevelsController');

        Route::get('profile', 'PlayersController@show');
        Route::put('profile', 'PlayersController@update');

        Route::resource('player-movie-collections', 'PlayerMovieCollectionsController');
        Route::resource('player-movies', 'PlayerMoviesController');
        Route::post('player-movies/copy-to-other-collection/{collection}', 'PlayerMoviesController@copyMoviesToOtherCollection');
        Route::get('player-movies/{playerMovie}/make-publish-request', 'PlayerMoviesController@makePublishRequest');

        Route::resource('abuses', 'AbusesController');

});
