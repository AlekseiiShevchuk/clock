@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.playerMovieCollection.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.playerMovieCollection.fields.player')</th>
                            <td>{{ $playerMovieCollection->player->device_id or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovieCollection.fields.language')</th>
                            <td>{{ $playerMovieCollection->language->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovieCollection.fields.name')</th>
                            <td>{{ $playerMovieCollection->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovieCollection.fields.description')</th>
                            <td>{{ $playerMovieCollection->description }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#playerMovie" aria-controls="playerMovie" role="tab" data-toggle="tab">PlayerMovie</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="playerMovie">
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('playermoviecollections.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop