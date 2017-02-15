@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.movies.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.movies.fields.name')</th>
                            <td>{{ $movie->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.movies.fields.description')</th>
                            <td>{{ $movie->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.movies.fields.movie-file')</th>
                            <td>@if($movie->movie_file)<a href="{{ asset('uploads/'.$movie->movie_file) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.movies.fields.answer')</th>
                            <td>{{ $movie->answer }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.movies.fields.level')</th>
                            <td>{{ $movie->level->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.movies.fields.language')</th>
                            <td>{{ $movie->language->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('movies.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop