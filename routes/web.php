<?php
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/thumb', function () {
    foreach (\App\Movie::all() as $movie){
        \App\Services\VideoThumbnailMaker::makeThumbnail($movie);
    }
    foreach (\App\PlayerMovie::all() as $movie){
        \App\Services\VideoThumbnailMaker::makeThumbnail($movie);
    }
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('languages', 'LanguagesController');
    Route::resource('levels', 'LevelsController');
    Route::post('levels_mass_destroy', ['uses' => 'LevelsController@massDestroy', 'as' => 'levels.mass_destroy']);
    Route::resource('movies', 'MoviesController');
    Route::post('movies_mass_destroy', ['uses' => 'MoviesController@massDestroy', 'as' => 'movies.mass_destroy']);
	Route::resource('players', 'PlayersController');
    Route::post('players_mass_destroy', ['uses' => 'PlayersController@massDestroy', 'as' => 'players.mass_destroy']);

    Route::resource('playermoviecollections', 'PlayerMovieCollectionsController');
    Route::post('playermoviecollections_mass_destroy', ['uses' => 'PlayerMovieCollectionsController@massDestroy', 'as' => 'playermoviecollections.mass_destroy']);

    Route::resource('playermovies', 'PlayerMoviesController');
    Route::get('playermovies/{id}/clone-to-level', 'PlayerMoviesController@cloneToLevelShow')->name('playermovies.clone-to-level');
    Route::post('playermovies/{id}/clone-to-level', 'PlayerMoviesController@cloneToLevelStore')->name('playermovies.clone-to-level');
    Route::post('playermovies_mass_destroy', ['uses' => 'PlayerMoviesController@massDestroy', 'as' => 'playermovies.mass_destroy']);

    Route::resource('abuses', 'AbusesController');
    Route::post('abuses_mass_destroy', ['uses' => 'AbusesController@massDestroy', 'as' => 'abuses.mass_destroy']);
	Route::resource('publish_requests', 'PublishRequestsController');
    Route::post('publish_requests_mass_destroy', ['uses' => 'PublishRequestsController@massDestroy', 'as' => 'publish_requests.mass_destroy']);

    Route::resource('translation_items', 'TranslationItemsController');
    Route::post('translation_items_mass_destroy',
        ['uses' => 'TranslationItemsController@massDestroy', 'as' => 'translation_items.mass_destroy']);
    Route::put('translation_items_mass_update',
        ['uses' => 'TranslationItemsController@massUpdate'])->name('translation_items.mass_update');

    Route::post('/excel-import', 'TranslationItemsController@importExcel');

    Route::get('/excel-export/{type}', 'TranslationItemsController@exportExcel');
});
