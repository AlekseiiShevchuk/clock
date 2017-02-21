@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.player.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.player.fields.device-id')</th>
                            <td>{{ $player->device_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.player.fields.nickname')</th>
                            <td>{{ $player->nickname }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#playerMovieCollection" aria-controls="playerMovieCollection" role="tab" data-toggle="tab">PlayerMovieCollection</a></li>
<li role="presentation" class=""><a href="#playerMovie" aria-controls="playerMovie" role="tab" data-toggle="tab">PlayerMovie</a></li>
<li role="presentation" class=""><a href="#abuses" aria-controls="abuses" role="tab" data-toggle="tab">Abuses</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="playerMovieCollection">
<table class="table table-bordered table-striped {{ count($playerMovieCollections) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.playerMovieCollection.fields.player')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.language')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.name')</th>
                        <th>@lang('quickadmin.playerMovieCollection.fields.description')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($playerMovieCollections) > 0)
            @foreach ($playerMovieCollections as $playerMovieCollection)
                <tr data-entry-id="{{ $playerMovieCollection->id }}">
                    <td>{{ $playerMovieCollection->player->device_id or '' }}</td>
                                <td>{{ $playerMovieCollection->language->name or '' }}</td>
                                <td>{{ $playerMovieCollection->name }}</td>
                                <td>{{ $playerMovieCollection->description }}</td>
                                <td>
                                    @can('playerMovieCollection_view')
                                    <a href="{{ route('playermoviecollections.show',[$playerMovieCollection->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('playerMovieCollection_edit')
                                    <a href="{{ route('playermoviecollections.edit',[$playerMovieCollection->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('playerMovieCollection_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['playermoviecollections.destroy', $playerMovieCollection->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="playerMovie">
<table class="table table-bordered table-striped {{ count($playerMovies) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.playerMovie.fields.player')</th>
                        <th>@lang('quickadmin.playerMovie.fields.language')</th>
                        <th>@lang('quickadmin.playerMovie.fields.collection')</th>
                        <th>@lang('quickadmin.playerMovie.fields.name')</th>
                        <th>@lang('quickadmin.playerMovie.fields.description')</th>
                        <th>@lang('quickadmin.playerMovie.fields.answer')</th>
                        <th>@lang('quickadmin.playerMovie.fields.movie-file')</th>
                        <th>@lang('quickadmin.playerMovie.fields.moderated')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($playerMovies) > 0)
            @foreach ($playerMovies as $playerMovie)
                <tr data-entry-id="{{ $playerMovie->id }}">
                    <td>{{ $playerMovie->player->device_id or '' }}</td>
                                <td>{{ $playerMovie->language->name or '' }}</td>
                                <td>{{ $playerMovie->collection->name or '' }}</td>
                                <td>{{ $playerMovie->name }}</td>
                                <td>{{ $playerMovie->description }}</td>
                                <td>{{ $playerMovie->answer }}</td>
                                <td>@if($playerMovie->movie_file)<a href="{{ asset('uploads/'.$playerMovie->movie_file) }}" target="_blank">Download file</a>@endif</td>
                                <td>{{ $playerMovie->moderated }}</td>
                                <td>
                                    @can('playerMovie_view')
                                    <a href="{{ route('playermovies.show',[$playerMovie->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('playerMovie_edit')
                                    <a href="{{ route('playermovies.edit',[$playerMovie->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('playerMovie_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['playermovies.destroy', $playerMovie->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="abuses">
<table class="table table-bordered table-striped {{ count($abuses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.abuses.fields.player-movie')</th>
                        <th>@lang('quickadmin.abuses.fields.description')</th>
                        <th>@lang('quickadmin.abuses.fields.by-player')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($abuses) > 0)
            @foreach ($abuses as $abuse)
                <tr data-entry-id="{{ $abuse->id }}">
                    <td>{{ $abuse->player_movie->name or '' }}</td>
                                <td>{{ $abuse->description }}</td>
                                <td>{{ $abuse->by_player->device_id or '' }}</td>
                                <td>
                                    @can('abus_view')
                                    <a href="{{ route('abuses.show',[$abuse->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('abus_edit')
                                    <a href="{{ route('abuses.edit',[$abuse->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('abus_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['abuses.destroy', $abuse->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('players.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop