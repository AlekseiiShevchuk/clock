<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Authentication Routes...
$this->get('/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('/login', 'Auth\LoginController@login')->name('auth.login');
$this->post('/logout', 'Auth\LoginController@logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');

    Route::get('/levels', 'LevelsController@index');
    Route::get('/levels/create', 'LevelsController@create');
    Route::post('/levels/store', 'LevelsController@store');

    Route::get('/levels/{id}/show', 'LevelsController@show');

    Route::get('/levels/{id}/edit', 'LevelsController@edit');
    Route::post('/levels/{id}/edit', 'LevelsController@update');

    Route::post('/levels/{id}/destroy', 'LevelsController@destroy');

    Route::get('/movies', 'MoviesController@index');
    Route::get('/movies/create', 'MoviesController@create');
    Route::post('/movies/store', 'MoviesController@store');

    Route::get('/movies/{id}/edit', 'MoviesController@edit');
    Route::post('/movies/{id}/edit', 'MoviesController@update');

    Route::post('/movies/{id}/destroy', 'MoviesController@destroy');

});