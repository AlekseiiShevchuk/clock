<?php

namespace App\Providers;

use App\Observers\PlayerMovieObserver;
use App\Observers\PlayerObserver;
use App\Player;
use App\PlayerMovie;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Player::observe(PlayerObserver::class);
        PlayerMovie::observe(PlayerMovieObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
