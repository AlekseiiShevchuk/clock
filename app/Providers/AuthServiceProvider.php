<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Languages
        Gate::define('language_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('language_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Levels
        Gate::define('level_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('level_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('level_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('level_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('level_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Movies
        Gate::define('movie_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('movie_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('movie_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('movie_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('movie_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });
		
		// Auth gates for: Player
        Gate::define('player_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: PlayerMovieCollection
        Gate::define('playerMovieCollection_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovieCollection_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovieCollection_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovieCollection_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovieCollection_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: PlayerMovie
        Gate::define('playerMovie_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovie_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovie_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovie_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('playerMovie_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Abuses
        Gate::define('abus_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('abus_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('abus_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('abus_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('abus_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
