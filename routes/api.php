<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/v1/levels', 'LevelsApiController@getAllLevels');
Route::get('/v1/levels/{id}', 'LevelsApiController@showLevelsId');
Route::get('/v1/levels/{id}/movies', 'LevelsApiController@showLevelMovies');

Route::get('/v1/movies', 'MoviesApiController@getAllMovies');
Route::get('/v1/movies/{id}', 'MoviesApiController@showMoviesId');
Route::get('/v1/movies/{id}/levels', 'MoviesApiController@showMoviesLevelID');