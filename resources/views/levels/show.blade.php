@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.levels.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.levels.fields.name')</th>
                            <td>{{ $level->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.levels.fields.description')</th>
                            <td>{{ $level->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.levels.fields.language')</th>
                            <td>{{ $level->language->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#movies" aria-controls="movies" role="tab" data-toggle="tab">Movies</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="movies">
<table class="table table-bordered table-striped {{ count($movies) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.movies.fields.name')</th>
                        <th>@lang('quickadmin.movies.fields.description')</th>
                        <th>@lang('quickadmin.movies.fields.movie-file')</th>
                        <th>@lang('quickadmin.movies.fields.answer')</th>
                        <th>@lang('quickadmin.movies.fields.level')</th>
                        <th>@lang('quickadmin.movies.fields.language')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($movies) > 0)
            @foreach ($movies as $movie)
                <tr data-entry-id="{{ $movie->id }}">
                    <td>{{ $movie->name }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>@if($movie->movie_file)<a href="{{ asset('uploads/'.$movie->movie_file) }}" target="_blank">Download file</a>@endif</td>
                                <td>{{ $movie->answer }}</td>
                                <td>{{ $movie->level->name or '' }}</td>
                                <td>{{ $movie->language->name or '' }}</td>
                                <td>
                                    @can('movie_view')
                                    <a href="{{ route('movies.show',[$movie->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('movie_edit')
                                    <a href="{{ route('movies.edit',[$movie->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('movie_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['movies.destroy', $movie->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('levels.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop