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