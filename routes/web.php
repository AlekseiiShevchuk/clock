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

// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');

    Route::get('/levels', 'LevelsController@index');
    Route::get('/level/create', 'LevelsController@create');
    Route::post('/level/store', 'LevelsController@store');

    Route::get('/level/show/{id}', 'LevelsController@show');

    Route::get('/level/edit/{id}', 'LevelsController@edit');
    Route::post('/level/edit/{id}', 'LevelsController@update');

    Route::post('/level/destroy/{id}', 'LevelsController@destroy');

    Route::get('/movies', 'MoviesController@index');
    Route::get('/movie/create', 'MoviesController@create');
    Route::post('/movie/store', 'MoviesController@store');

    Route::get('/movie/edit/{id}', 'MoviesController@edit');
    Route::post('/movie/edit/{id}', 'MoviesController@update');

    Route::post('/movie/destroy/{id}', 'MoviesController@destroy');

});