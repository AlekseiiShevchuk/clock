@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.playerMovie.title')</h3>
    @can('playerMovie_create')
    <p>
        <a href="{{ route('playermovies.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($playerMovies) > 0 ? 'datatable' : '' }} @can('playerMovie_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('playerMovie_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

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
                                @can('playerMovie_delete')
                                    <td></td>
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('playerMovie_delete')
            window.route_mass_crud_entries_destroy = '{{ route('playermovies.mass_destroy') }}';
        @endcan

    </script>
@endsection