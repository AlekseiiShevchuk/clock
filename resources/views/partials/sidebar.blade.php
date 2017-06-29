@inject('request', 'Illuminate\Http\Request')
<ul class="nav" id="side-menu">

    <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
        <a href="{{ url('/') }}">
            <i class="fa fa-wrench"></i>
            <span class="title">@lang('quickadmin.dashboard')</span>
        </a>
    </li>

    
            @can('user_management_access')
            <li class="">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                
                @can('role_access')
                <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('language_access')
            <li class="{{ $request->segment(1) == 'languages' ? 'active' : '' }}">
                <a href="{{ route('languages.index') }}">
                    <i class="fa fa-language"></i>
                    <span class="title">@lang('quickadmin.languages.title')</span>
                </a>
            </li>
            @endcan
            
            @can('level_access')
            <li class="{{ $request->segment(1) == 'levels' ? 'active' : '' }}">
                <a href="{{ route('levels.index') }}">
                    <i class="fa fa-angle-double-up"></i>
                    <span class="title">@lang('quickadmin.levels.title')</span>
                </a>
            </li>
            @endcan
            
            @can('movie_access')
            <li class="{{ $request->segment(1) == 'movies' ? 'active' : '' }}">
                <a href="{{ route('movies.index') }}">
                    <i class="fa fa-file-movie-o"></i>
                    <span class="title">@lang('quickadmin.movies.title')</span>
                </a>
            </li>
            @endcan
            
            @can('player_access')
            <li class="{{ $request->segment(1) == 'players' ? 'active' : '' }}">
                <a href="{{ route('players.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.player.title')</span>
                </a>
            </li>
            @endcan
            
            @can('playerMovieCollection_access')
            <li class="{{ $request->segment(1) == 'playerMovieCollections' ? 'active' : '' }}">
                <a href="{{ route('playermoviecollections.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.playerMovieCollection.title')</span>
                </a>
            </li>
            @endcan
            
            @can('playerMovie_access')
            <li class="{{ $request->segment(1) == 'playerMovies' ? 'active' : '' }}">
                <a href="{{ route('playermovies.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">Player`s Movies</span>
                </a>
            </li>
            @endcan
            
            @can('abus_access')
            <li class="{{ $request->segment(1) == 'abuses' ? 'active' : '' }}">
                <a href="{{ route('abuses.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.abuses.title')</span>
                </a>
            </li>
            @endcan
			

            <li class="{{ $request->segment(1) == 'publish_requests' ? 'active' : '' }}">
                <a href="{{ route('publish_requests.index') }}">
                    <i class="fa fa-puzzle-piece"></i>
                    <span class="title">@lang('quickadmin.publish-request.title')</span>
                </a>
            </li>
            <li class="{{ $request->segment(2) == 'translation_items' ? 'active' : '' }}">
                <a href="{{ route('translation_items.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.translation-items.title')</span>
                </a>
            </li>
            

    <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.logout')</span>
                </a>
            </li>
</ul>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}