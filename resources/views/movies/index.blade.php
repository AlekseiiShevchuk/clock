@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.movies.title')</h3>
    @can('movie_create')
    <p>
        <a href="{{ route('movies.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($movies) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('movie_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

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
                                @can('movie_delete')
                                    <td></td>
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('movie_delete')
            window.route_mass_crud_entries_destroy = '{{ route('movies.mass_destroy') }}';
        @endcan

    </script>
@endsection