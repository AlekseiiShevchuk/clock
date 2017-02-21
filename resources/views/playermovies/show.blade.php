@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.playerMovie.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.player')</th>
                            <td>{{ $playerMovie->player->device_id or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.language')</th>
                            <td>{{ $playerMovie->language->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.collection')</th>
                            <td>{{ $playerMovie->collection->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.name')</th>
                            <td>{{ $playerMovie->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.description')</th>
                            <td>{{ $playerMovie->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.answer')</th>
                            <td>{{ $playerMovie->answer }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.movie-file')</th>
                            <td>@if($playerMovie->movie_file)<a href="{{ asset('uploads/'.$playerMovie->movie_file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.playerMovie.fields.moderated')</th>
                            <td>{{ $playerMovie->moderated }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#abuses" aria-controls="abuses" role="tab" data-toggle="tab">Abuses</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="abuses">
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

            <a href="{{ route('playermovies.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop